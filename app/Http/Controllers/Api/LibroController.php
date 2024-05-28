<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Libro;
use Illuminate\Http\Request;

class LibroController extends Controller
{

    public function index()
    {
        $libros = Libro::all();
        return $libros;
    }

    public function store(Request $request)
    {
        //'titulo','autor','editorial','edicion','stock'
        $libro = new Libro();
        $libro->titulo=$request->titulo;
        $libro->autor=$request->autor;
        $libro->editorial=$request->editorial;
        $libro->edicion=$request->edicion;
        $libro->stock=$request->stock;
        $libro->save();
    }

    public function show($id)
    {
        $Libro = Libro::find($id);
        return $Libro;
    }

     public function update(Request $request, $id)
    {
        $Libro = Libro::findOrFail($request->id);
        $libro->titulo->$request->titulo;
        $libro->autor->$request->autor;
        $libro->editorial->$request->editorial;
        $libro->edicion->$request->edicion;
        $libro->stock->$request->stock;

        $libro->save();
        return $Libro;

    }


    public function destroy($id)
    {
        $libro = Libro::destroy($id);
        return $libro;
    }
}
