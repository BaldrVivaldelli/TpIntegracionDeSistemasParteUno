<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
class UserController extends Controller
{
     function getAll(){
        return view("users",[
            "users"=> User::all()
        ]);
    }
    
    function add(Request $req){
      $user = new User;
      $user->name = $req->name;
      $user->email = $req->email;
      $user->password = $req->password;
      $user->save();
        return view("users",[
            "users"=> User::all()
        ]);
    }
}
