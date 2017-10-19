<?php

namespace App\Http\Controllers;

use App\File;


use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LogOutController extends Controller
{
    
    use AuthenticatesUsers;

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        Auth::logout();
    }
}