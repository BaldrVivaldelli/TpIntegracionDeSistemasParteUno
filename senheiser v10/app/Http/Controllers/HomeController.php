<?php

namespace App\Http\Controllers;

use App\File;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


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
		$id = Auth::user()->id;
		$myFiles = File::where("user_id",$id)->get();
		// esto debugea y muere ahi
		//dd($myFiles);
        return view('home',[ "myFiles" => $myFiles ]);
    }
}
