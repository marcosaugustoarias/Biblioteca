<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{

    public function index()
    {
        $usuarios = Usuario::all();
        return $usuarios;
    }

    public function store(Request $request)
    {
         $usuario = new Usuario();
         $usuario->nombre=$request->nombre;
         $usuario->apellido=$request->apellido;
         $usuario->email=$request->email;
         $usuario->libros_prestados=$request->libros_prestados;
         $usuario->save();
    }

    public function show($id)
    {
        $Usuario = Usuario::find($id);
        return $Usuario;
    }

    public function update(Request $request, $id)
    {
        $Usuario = Usuario::findOrFail($request->id);

        $usuario = new Usuario();
        $usuario->nombre=$request->nombre;
        $usuario->apellido=$request->apellido;
        $usuario->email=$request->email;
        $usuario->libros_prestados=$request->libros_prestados;
        $usuario->save();

        return $Usuario;

    }

    public function destroy($id)
    {
        $usuario = Usuario::destroy($id);
        return $usuario;
    }
}
