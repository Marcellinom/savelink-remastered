<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Main;
use App\Models\Tag;
use OpenGraph;

class inputController extends Controller
{
    public function input_table(Request $req)
    {
        //return dd(request()->user());
        // switch ($req->input('action')) {
                $data = new Main;
                if(str_contains($req->url, "youtube.com/watch?v=")){
                    $temp = OpenGraph::fetch($req->url);
                    if(isset($temp['title'])){
                        $data->name = $temp['title'];
                    }
                    $data->url = str_replace("watch?v=","embed/",$req->url);
                } else if(str_contains($req->url, "https://") || str_contains($req->url, "http://")){
                    $temp = OpenGraph::fetch($req->url);
                    if(isset($temp['title'])){
                        $data->name = $temp['title'];
                    }
                    if(isset($temp['image'])){
                        $data->img_url = $temp['image'];
                    }
                }
                if($req->name) {
                    $data->name = $req->name;
                }
                $data->url = $req->url;
                $data->user_id = request()->user()->id;
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
        $tags = Tag::where('user_id', request()->user()->id)
                   ->where('tags',$req->old)
                   ->update(['tags'=>$req->new]);

        $data = Main::where('user_id',$id)
                    ->where('type',$req->old)
                    ->update(['type'=>$req->new]);
        return redirect()->back();
    }
    public function purge(Request $req) {
        $id = Auth::user()->id;
        $data = Main::where('user_id',$id)
                    ->where('type',$req->tag)
                    ->delete();
        return redirect()->back();
    }
}
