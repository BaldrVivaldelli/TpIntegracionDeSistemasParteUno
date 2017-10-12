<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\File;

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
		$file->name = $req->myFile->getClientOriginalName();
		$file->size = $req->myFile->getClientSize();
		$file->mime_type = $req->myFile->getClientMimeType();
		$file->path = $req->file('myFile')->store('myCloud-'.$id);
		$file->user()->associate(Auth::user());
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
        $file = File::where("user_id",$id)->get();
        Response::download($file, 'filename.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        

        //esto me va a borrar del storage el archivo que le diga. De todas formas el find or fail me tiene que traer la dirreccion
        Storage::delete(File::findOrFail($id));                
		File::findOrFail($id)->delete();    
		return redirect('/home');
    }
}
