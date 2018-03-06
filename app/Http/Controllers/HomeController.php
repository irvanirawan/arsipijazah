<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kelas = DB::table('kelas')->join('tahun_ajaran','kelas.tahun_ajaran','=','tahun_ajaran.id')->where('tahun_ajaran.status','=',2)->get();
        $arrdata = array();
        foreach ($kelas as $key => $value) {
            $arrdata[] = [];
        }
        return view('home');
    }
}
