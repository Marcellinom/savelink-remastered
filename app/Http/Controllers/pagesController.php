<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pekob;
use App\Models\School;
use Yajra\Datatables\Datatables;

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
        $data = Pekob::select('name', 'url', 'time')->get();
       // return dd($data);
        return view('pages.pekob')->with('data_tables',$data);
    }

    function input_table(Request $req)
    {
        switch ($req->input('action')) {
            case 'school-btn':
                $data = new School;
                $data->name = $req->name;
                $data->url = $req->url;
                $data->time = $req->time;
                $data->save();
                return redirect('');
                break;

            case 'pekob-btn':
                $data = new Pekob;
                $data->name = $req->name;
                $data->url = $req->url;
                $data->time = $req->time;
                $data->save();
                return redirect('');
                break;
        }
    }
}
