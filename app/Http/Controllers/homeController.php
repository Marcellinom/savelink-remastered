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
        $nav_types = Tag::select('tags')
                        ->where('user_id', request()->user()->id)
                        ->get();
        $nav_nsfws = Tag::select('tags')
                        ->where('user_id', request()->user()->id)
                        ->where('nsfw', "1")
                        ->get();
        $tab = [];
        foreach($nav_types as $i=>$nav_type){
            $tab[$i] = $nav_type->tags;
        }
        $nsfw_mark = [];
        foreach($nav_nsfws as $nav_nsfw){
            $nsfw_mark[$nav_nsfw->tags] = "nsfw";
        }
        return view('dashboard')
            ->with('data',$tab)
            ->with('data_nsfw',$nsfw_mark);
    }
    public function account()
    {  
        $nav_types = Tag::select('tags')
                        ->where('user_id', request()->user()->id)
                        ->get();
        $nav_nsfws = Tag::select('tags')
                        ->where('user_id', request()->user()->id)
                        ->where('nsfw', "1")
                        ->get();
        $tab = [];
        foreach($nav_types as $i=>$nav_type){
            $tab[$i] = $nav_type->tags;
        }
        $nsfw_mark = [];
        foreach($nav_nsfws as $nav_nsfw){
            $nsfw_mark[$nav_nsfw->tags] = "nsfw";
        }
        return view('account')
        ->with('data',$tab)
        ->with('data_nsfw',$nsfw_mark);
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
        if(isset($req->nsfw)){
            $add->nsfw = $req->nsfw;
        } 
        $add->save();
        return redirect()->back();
    }
    public function view($tag)
    {
// navbar data----------------------------------------------------------
        $nav_types = Tag::select('tags')
                        ->where('user_id', request()->user()->id)
                        ->get();
        $nav_nsfws = Tag::select('tags')
                        ->where('user_id', request()->user()->id)
                        ->where('nsfw', "1")
                        ->get();
        $tab = [];
        foreach($nav_types as $i=>$nav_type){
            $tab[$i] = $nav_type->tags;
        }
        $nsfw_mark = [];
        foreach($nav_nsfws as $nav_nsfw){
            $nsfw_mark[$nav_nsfw->tags] = "nsfw";
        }
//-----------------------------------------------------------------------
        $title_nsfw = Tag::select('nsfw')
                         ->where('tags', $tag)
                         ->get();
        $id = Auth::user()->id;
        $data = Main::select('name','url','time','img_url', 'id', 'img')
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
             ->with('nsfw_title', $title_nsfw[0])
             ->with('nsfw_mark', $title_nsfw[0]->nsfw)
             ->with('data',$tab)
             ->with('data_nsfw',$nsfw_mark);
    }
}
