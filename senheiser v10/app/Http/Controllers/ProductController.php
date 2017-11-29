<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Product;
use App\File;


class ProductController extends Controller
{
    function getAll(){
        $allPublicFiles = File::where("public_share","0")->get();
        //el que envio como response
        $result =array();
        foreach ($allPublicFiles as $myFile){

            //aca creo un array con los datos que estan en la tabla
            $auxProducto = array();

            $auxProducto["nombre"] = $myFile->name;
            $auxProducto["hashName"] = $myFile->hashName;
            $auxProducto["size"] = $myFile->size;
            $auxProducto["mime_type"] = $myFile->mime_type;
            array_push($result,$auxProducto);
        }
        return $result;
    }
    
    function add(Request $req){
      $prod = new Product;
      $prod->name = $req->name;
      $prod->amount = $req->amount;
      $prod->available = $req->available;
      $prod->save();

    }

    function getAllFileName(){
        $allPublicFiles = $allPublicFiles = File::where("public_share","0")->get();
        $result =array();
        foreach ($allPublicFiles as $myFiles){
            array_push($result,$myFiles->name);
        }
        return $result;
    }

    function getFileById($hashName){
        
        
        $file = File::where("hashName",$hashName)->get();        
        //dd($file[0]->path);
        $filePath = $file[0]->path;
        
        $mimetype = Storage::mimeType($filePath);
        return response(Storage::get($filePath), 200)->header('Content-Type', $mimetype);
        
    }

    function getFileByTagName(Request $hashName){
        //?hashName={hashName}
        //dd($hashName->name);
        $allFiles = File::where("name", 'LIKE', "%{$hashName->value}%")->get();        
        $result =array();
        foreach ($allFiles as $myFile){

            //aca creo un array con los datos que estan en la tabla
            $auxProducto = array();

            $auxProducto["nombre"] = $myFile->name;
            $auxProducto["hashName"] = $myFile->hashName;
            $auxProducto["size"] = $myFile->size;
            $auxProducto["mime_type"] = $myFile->mime_type;
            array_push($result,$auxProducto);
        }
        return $result;        
    }

    //preguntar al profe como poder usar esto
    function getAllData(){

        return $allPublicFiles = File::where("public_share","0")->get();
    }

}