<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Main;
use App\Models\Tag;
use Cloudinary\Api\Upload\UploadApi;
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
    public function account()
    {  
        $tags = Tag::select('tags')
                   ->where('user_id', request()->user()->id)
                   ->get();
        $data = [];
        foreach($tags as $i=>$tag){
            $data[$i] = $tag->tags;
        }
        return view('account')->with('data',$data);
    }
    public function addTag(Request $req)
    {   
        if($req->add == null) {
            return redirect()->back()->with('alert_danger', "New Tag name cannot be empty!!");
        }
        if(isset(Tag::where('tags',$req->add)->get()[0])){
            return redirect()->back()->with('alert_danger', "Tag Already Exist!!");
        } 
        $add = new Tag;
        $add->user_id = request()->user()->id;
        $add->username = request()->user()->name;
        $add->tags = $req->input('add');
        $add->save();
        return redirect()->back();
    }
    public function view($tag)
    {
// navbar data----------------------------------------------------------
        $nav_types = Tag::select('tags')
                   ->where('user_id', request()->user()->id)
                   ->get();
        $tab = [];
        foreach($nav_types as $i=>$nav_type){
            $tab[$i] = $nav_type->tags;
        }
//-----------------------------------------------------------------------
        $id = Auth::user()->id;
        $data = Main::select('name','url','time','img_url', 'id')
                    ->where('user_id',$id)
                    ->where('type',$tag)
                    ->get();
         if(!Tag::where('user_id',$id)
                ->where('tags', '=', $tag)
                ->exists())
        {
            return redirect()->guest('home');
        }
        return view('driver')
             ->with('list_items',$data)
             ->with('title', $tag)
             ->with('data',$tab);
    }
}
