<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Main;
use App\Models\Tag;
use OpenGraph;
use Cloudinary\Api\Upload\UploadApi;
class inputController extends Controller
{
    public function input_table(Request $req)
    {
        $data = new Main;

        if($req->select_tag == "Add-Tag"){
            return redirect()->back()->with('alert', "please valid Tag!");
        }
        $temp = Tag::select('nsfw')
                   ->where('tags', $req->select_tag)
                   ->where('user_id', Auth::user()->id)
                   ->get();
        if(isset($temp[0]->nsfw) && !isset($req->nsfw)){
            return redirect()->back()->with('alert_underline',$req->select_tag)->with('alert'," Tag is NSFW!!");
        }
        if(isset($req->nsfw)){
            if(!isset($temp[0]->nsfw)){
                return redirect()->back()->with('alert', $req->select_tag." is not an NSFW Tag!!");
            } 
            //add img field of nsfw
            $data->img = "1";
        }
                $url = $req->url;
                
                if(is_numeric($url)) $url = "https://nhentai.net/g/".$url;
                
                $data->url = $url;
                
                if(str_contains($url, "youtube.com/watch?v=")){
                    $temp = OpenGraph::fetch($url);
                    if(isset($temp['title'])){
                        $data->name = $temp['title'];
                    }
                    $data->url = str_replace("watch?v=","embed/",$req->url);
                } else if(str_contains($url, "https://") || str_contains($url, "http://")){
                    $temp = OpenGraph::fetch($url);
                    if(isset($temp['title'])){
                        $data->name = $temp['title'];
                    }
                    if(isset($temp['image'])){
                        //filling img_url table with image link
                        $data->img_url = $temp['image'];
                        if(isset($req->nsfw)){

                            //gets binary image
                            $temp_img = file_get_contents($temp['image']);
                            
                            //uploads it to cdn
                            $data->img_url = cloudinary()->upload("data:image/png;base64,".base64_encode($temp_img))->getSecurePath();
                        }
                    }
                }
                if($req->name) {
                    $data->name = $req->name;
                }
                $data->user_id = Auth::user()->id;
                $data->type = $req->select_tag;
                
                if($data->name == null && $data->url == null){
                    return redirect()->back()->with('alert', "please insert data!");
                }
                if($data->url == null){
                    return redirect()->back()->with('alert', "please insert a link!");
                }
                if($data->name == null){
                    return redirect()->back()->with('alert', "uh-oh! - You'll have to insert the title for this one!");
                }
                $data->save();
                return redirect()->back();
    }
    public function delete(Request $req) {
        $id = Auth::user()->id;
        $tags = Tag::select('tags')
                   ->where('user_id', request()->user()->id)
                   ->where('tags',$req->tag)
                   ->delete();
        $data = Main::select('name','url','time','img','img_url')
                    ->where('user_id',$id)
                    ->where('type',$req->tag)
                    ->delete();
        return redirect()->back();
    }
    public function edit(Request $req) {
        $id = Auth::user()->id;
        if(isset($req->nsfw)){
            Tag::where('user_id', $id)
                   ->where('tags',$req->old)
                   ->update(['nsfw'=> "1", 'tags'=>$req->new]);
            Main::where('user_id',$id)
                   ->where('type',$req->old)
                   ->update(['img'=> "1", 'type'=>$req->new]);
        } else {
         Tag::where('user_id', $id)
            ->where('tags',$req->old)
            ->update(['nsfw'=>null, 'tags'=>$req->new]);
         Main::where('user_id',$id)
            ->where('type',$req->old)
            ->update(['img'=>null,'type'=>$req->new]);
        }
        return redirect()->back();
    }
    public function purge(Request $req) {
        $id = Auth::user()->id;
        $data = Main::where('user_id',$id)
                    ->where('type',$req->tag)
                    ->delete();
        return redirect()->back();
    }
    public function deleteContent(Request $req) {
                Main::where('id',$req->delete_id)
                    ->delete();
        return redirect()->back();
    }
    public function moveContent(Request $req) {
        if($req->select_tag == "Add-Tag"){
            return redirect()->back()->with('alert', "please choose a valid Tag!");
        }
        $nsfw_check = Tag::select('nsfw')
                    ->where('tags', $req->select_tag)
                    ->get()[0]->nsfw;
        if(gettype($nsfw_check) != gettype($req->nsfw)){
            if(!$nsfw_check){
                return redirect()->back()->with('alert', "Link content is NSFW! and Tag destination isn't NSFW!!");
            } else {
                Main::where('id', $req->move_id)
                    ->update(['img' => "1"]);
            }
        } 
        Main::where('id', $req->move_id)
            ->update(['type' => $req->select_tag]);
    return redirect()->back();
    }
    
    public function editContent(Request $req) {
        $temp = Tag::select('nsfw')
        ->where('user_id', Auth::user()->id)
        ->where('tags', $req->tag)
        ->get();
        $selected = Main::select('img')
                        ->where('id', $req->edit_id)
                        ->get()[0];
        if($req->nsfw != $selected->img){
            if(null == $temp[0]->nsfw){
                return redirect()->back()->with('alert', "This is not an NSFW tag");
            } else {
                Main::where('id',$req->edit_id)
                ->update([
                'img' => $req->nsfw,
                ]);
            }
        } 

        if($req->new_title == $req->old_title && $req->new_url == $req->old_url) {
            return redirect()->back();
        }

        if($req->new_url != $req->old_url){
            $url = $req->new_url;
            if(is_numeric($url)) $url = "https://nhentai.net/g/".$url;

            if(str_contains($url, "youtube.com/watch?v=")){
                $temp = OpenGraph::fetch($url);
                if(isset($temp['title'])){
                    $title = $temp['title'];
                }
                $url = str_replace("watch?v=","embed/",$url);
            } else if(str_contains($url, "https://") || str_contains($url, "http://")){
                $temp = OpenGraph::fetch($url);
                if(isset($temp['title'])){
                    $title = $temp['title'];
                }
                if(isset($temp['image'])){
                    //filling img_url table with image link
                $img_url = $temp['image'];
                    if(isset($req->nsfw)){
                        //gets binary image
                        $temp_img = file_get_contents($temp['image']);
                        
                        //uploads it to cdn
                        $data->img_url = cloudinary()->upload("data:image/png;base64,".base64_encode($temp_img))->getSecurePath();
                    }
                }
            }
            Main::where('id',$req->edit_id)
                ->update([
                'name' => isset($title)?$title:$req->new_title,
                'url' => isset($url)?$url:$req->new_title,
                'img_url' => isset($img_url)?$img_url:null
                ]);
        }
        if($req->new_title != $req->old_title){
            if($req->new_title == null){
                if(str_contains($req->new_url, "https://") || str_contains($req->new_url, "http://")){
                    $temp = OpenGraph::fetch($req->new_url);
                    $req->new_title = $temp['title'];
                }
            }
            Main::where('id',$req->edit_id)
            ->update([
                'name' => $req->new_title
                ]);
        }
        return redirect()->back();
    }
}
