<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Reserva;
use App\Models\Usuario;
use App\Models\Libro;
use Illuminate\Http\Request;

class ReservaController extends Controller
{
    public function index()
    {
        $reservas = Reserva::with('libro', 'usuario')->get();
        return response()->json($reservas);
    }

    public function searchByUsuario($nombre)
    {
        $reservas = Reserva::whereHas('usuario', function($query) use ($nombre) {
            $query->where('nombre', 'like', "%$nombre%");
        })->with('libro', 'usuario')->get();
        return response()->json($reservas);
    }

    public function store(Request $request)
    {
        $usuario = Usuario::findOrFail($request->usuario_id);
        if ($usuario->libros_prestados >= 5) {
            return response()->json(['error' => 'El usuario ya tiene 5 libros prestados'], 400);
        }

        $libro = Libro::findOrFail($request->libro_id);
        if ($libro->stock == 0) {
            $reserva = Reserva::create([
                'libro_id' => $libro->id,
                'usuario_id' => $usuario->id,
                'activo' => false,
            ]);
            return response()->json(['message' => 'Libro no disponible. Añadido a la lista de espera'], 200);
        }

        $libro->stock -= 1;
        $libro->save();
        $usuario->libros_prestados += 1;
        $usuario->save();

        $reserva = Reserva::create($request->all());
        return response()->json($reserva, 201);
    }

    public function update(Request $request, $id)
    {
        $reserva = Reserva::findOrFail($id);
        $reserva->update($request->all());
        return response()->json($reserva);
    }

    public function destroy($id)
    {
        $reserva = Reserva::findOrFail($id);
        $reserva->delete();
        return response()->json(['message' => 'Reserva eliminada'], 200);
    }
}
