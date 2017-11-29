<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;
use App\File;
use Response;
use Illuminate\Support\Facades\Auth;
//esto sirve para eliminar el file del storage
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
	
		
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $req)
    {
		$id = Auth::user()->id;
        $file = new File();
        
        $withoutExt = preg_replace('/\\.[^.\\s]{3,4}$/', '', $req->myFile->getClientOriginalName());
		$file->name = $withoutExt; 
		$file->size = $req->myFile->getClientSize();
		$file->mime_type = $req->myFile->getClientMimeType();
        $file->path = $req->file('myFile')->store('myCloud-'.$id);
        $file->user()->associate(Auth::user());
        $file->hashName =  md5($withoutExt . microtime());
        $file->hashTags =  "";
		$file->save();
		
        return app('App\Http\Controllers\HomeController')->index();
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //esta funcion lo que hace es buscar el id del archivo para despues en base a donde esta hubicado en el storage bajarla

        
        $file = File::findOrFail($id);
        $fileStatus = $file->public_share;
        $filePath = $file->path;
        

        if($fileStatus == "0" && $file->user_id !== Auth::user()->id)
        {
            return redirect('/home'); 
        }else{    
            $mimetype = Storage::mimeType($filePath);
            return response(Storage::get($filePath), 200)->header('Content-Type', $mimetype);
        }
        
        //$type = File::findOrFail($id)->mime_type;  
     //   Response::download($path, $type);
        //return response()->download(storage_path("{$path}"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id,Request $req)
    {
        $file = File::findOrFail($id);
        if($file->user_id !== Auth::user()->id){
            // ERROR
        }
    
        foreach($req->only(['name', 'public_share']) as $k => $v){
            $file->$k = $v;
        }

        $file->save();
        
        return redirect('/home');
        }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $path = File::findOrFail($id)->path;  
        //esto me va a borrar del storage el archivo que le diga. De todas formas el find or fail me tiene que traer la dirreccion
        Storage::delete( $path );                
		File::findOrFail($id)->delete();    
		return redirect('/home');
    }


    public function detail($id){
        
        $file = $allPublicFiles = File::where("hashName",$id)->get();
        $result =array();
        foreach ($file as $fileDetail){

            //aca creo un array con los datos que estan en la tabla
            $auxProducto = array();

            $auxProducto["nombre"] = $fileDetail->name;
            $auxProducto["hashName"] = $fileDetail->hashName;
            $auxProducto["hashTags"] = $fileDetail->hashTags;
            $auxProducto["size"] = $fileDetail->size;
            $auxProducto["mime_type"] = $fileDetail->mime_type;
            array_push($result,$auxProducto);
        }        

         //return View::make('productDetail',[ "fileDetail" => $result ]);
        return view('productDetail',[ "detailData" => $result ]);
//        return redirect()->route('/productDetail', $result);
    }

}
