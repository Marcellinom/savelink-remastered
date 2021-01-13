<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pekob;
use App\Models\School;
use Yajra\Datatables\Datatables;
use OpenGraph;
class pagesController extends Controller
{
    public function home()
    {
        return view('pages.index');
    }
    
    public function school()
    {
        $data = School::select('name', 'url', 'time')->get();
       // return dd($data);
        return view('pages.school')->with('data_tables',$data);
    }
    
    public function pekob()
    {
        $data = Pekob::select('name', 'url', 'time', 'img_url')->get();
            //return dd($image);
        return view('pages.pekob')
                ->with('list_items',$data);
    }

    public function input_table(Request $req)
    {
        switch ($req->input('action')) {
            case 'school-btn':
                $data = new School;
                $data->name = $req->name;
                $data->url = $req->url;
                $data->time = $req->time->useCurrent();

                if($data->name == null || $data->url == null){
                    return view('pages.index');
                }

                $data->save();
                return redirect('');
                break;

            case 'pekob-btn':
                $data = new Pekob;
                $data->name = $req->name;
                $data->time = $req->time;
                $temp_url = $req->url;
                
                if(is_numeric($req->url)){
                    $temp_url = "https://nhentai.net/g/".$temp_url;
                    $temp = OpenGraph::fetch($temp_url);
                    $data->img_url = $temp['image'];

                } else if(str_contains($req->url, "https://") || str_contains($req->url, "http://")){   
                    $temp = OpenGraph::fetch($req->url);   
                    $data->img_url = $temp['image'];
                }

                $data->url = $temp_url;
               // return dd($data);
                if($data->name == null || $data->url == null){
                    return view('pages.index');
                }
                $data->save();
                return redirect('');
                break;
        }
    }
}

/*
if(str_contains($req->url, "savelink")) {
                    $data->url = OpenGraph::fetch($req->url);
                    return ($data->title);  // task= returning the image link
                } else {

                }
*/