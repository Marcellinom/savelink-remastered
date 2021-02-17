<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Main;
use App\Models\Tag;
class homeController extends Controller
{
    public function index()
    {   
        $tags = Tag::select('tags')
                   ->where('user_id', request()->user()->id)
                   ->get();
        $data = [];
        foreach($tags as $i=>$tag){
            $data[$i] = $tag->tags;
        }
        // return dd($data);
        return view('dashboard')->with('data',$data);
    }
    public function addTag(Request $req)
    {   
        // return dd(request()->user());
        $add = new Tag;
        $add->user_id = request()->user()->id;
        $add->username = request()->user()->name;
        $add->tags = $req->input('add');
        $add->save();
        return redirect()->back();
    }
}
