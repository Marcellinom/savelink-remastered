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
        $data = Pekob::select('name', 'url', 'time', 'img', 'img_url')->get();
        // encode binary to base64
        // foreach($data as $item){
        //     $item->img= 'data:image/' . 'png' . ';base64,' . base64_encode($item->img);
        // }
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

                if($data->name == null || $data->url == null){
                    return view('pages.index');
                }

                $data->save();
                return redirect('');
                break;

            case 'pekob-btn':
                $data = new Pekob;
                $data->name = $req->name;
                $temp_url = $req->url;
                
                if(is_numeric($req->url)){
                    $temp_url = "https://nhentai.net/g/".$temp_url;
                    $temp = OpenGraph::fetch($temp_url);
                    $data->img_url = $temp['image'];

                } else if(str_contains($req->url, "nhentai") || str_contains($req->url, "youtube") || str_contains($req->url, "pixiv")){   
                    $temp = OpenGraph::fetch($req->url);   
                    $data->img_url = $temp['image'];
                    // $url = $temp['image'];
                    // $img = public_path('images') . '\\'.$req->name.'.jpg';
                    $temp_img = file_get_contents($temp['image']);
                    $data->img= 'data:image/' . 'png' . ';base64,' . base64_encode($temp_img);
                }

                $data->url = $temp_url;
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