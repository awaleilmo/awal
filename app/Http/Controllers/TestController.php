<?php

namespace App\Http\Controllers;
use App\UserTest;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables as Datatables;

class TestController extends Controller
{
    public function index(){
        $usertest = UserTest::all();
        return view("index",compact('usertest'));
    }

    public function store(Request $request){


            $nama  = $request->nama;
            $check = UserTest::create(['nama' => $nama]);
            $arr = array('msg' => 'Terjadi Kesalahan, Coba Lagi', 'status' => false);
            if($check){
                $arr = array('msg' => 'Berhasil Disimpan', 'status' => true);
            }
            return Response()->json($arr);
            //return redirect("index");

    }
    public function ax(){
        if(request()->ajax()) {
            return Datatables()->of(UserTest::select('*'))
                ->editColumn('id', function ($row){
                    $k = $row->id - 1;
                    return $k;
                })
                ->addColumn('partity', function($row){
                    $k = $row->id - 1;
                    $ss = $k % 2;
                    if($ss == 0){
                       $btn = "Even";
                    }else{
                       $btn = "Odd";
                    }

                    return $btn;

                })
                ->toJson();
        }
    }
}
