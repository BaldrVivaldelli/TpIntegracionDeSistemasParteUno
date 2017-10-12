<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;


class ProductController extends Controller
{
    function getAll(){
        return view("products",[
            "products"=> Product::all()
        ]);
    }
    
    function add(Request $req){
      $prod = new Product;
      $prod->name = $req->name;
      $prod->amount = $req->amount;
      $prod->available = $req->available;
      $prod->save();
        return view("products",[
            "products"=> Product::all()
        ]);
    }

}
