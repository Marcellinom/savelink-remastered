<?php

namespace App\View\Components;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;
use Illuminate\Http\Request;
use App\Models\Main;
use App\Models\Tag;
class AppLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {   
        // $tags = Tag::select('tags')
        //            ->where('user_id', request()->user()->id)
        //            ->get();
        // $data = [];
        // foreach($tags as $i=>$tag){
        //     $data[$i] = $tag->tags;
        // }
        // return view('layouts.app')->with('data',$data);
        return view('layouts.app');
    }
}
