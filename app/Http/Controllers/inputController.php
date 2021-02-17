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
}
