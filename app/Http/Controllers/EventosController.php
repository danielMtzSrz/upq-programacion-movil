<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Eventos;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

use SimpleSoftwareIO\QrCode\Facades\QrCode;

class EventosController extends Controller
{

    public function index(Request $request)
    {
        $eventos = Eventos::all();

        $usuarios = User::get()->map(function($user){
            return [
                'id' => $user->id,
                'nombre' => $user->name." ".$user->apellido_paterno." ".$user->apellido_materno
            ];
        });

        return Inertia::render('Eventos/Index', compact('eventos', 'usuarios'));
    }

    public function store(Request $request)
    {
        $input = $request->all();

        // dd($input);

        $evento = Eventos::create([
            "id_usuario" => $input["id_usuario"],
            "nombre" => $input["nombre"],
            "descripcion" => $input["descripcion"],
            "ubicacion" => $input["ubicacion"],
            "fecha_evento" => $input["fecha_evento"],
            "capacidad" => $input["capacidad"],
            "registrados" => $input["registrados"],
            "status" => $input["status"],
        ]);

        $evento_url = "evento/$evento->id";

        $evento_qr_name = $evento->id . "-" . str_replace(' ', '', $evento->nombre);

        QrCode::generate($evento_url, public_path("images/eventos/$evento_qr_name.svg"));

        // Cargar imagen
        if($request->file('fotografia')){
            $evento->fotografia = $request->file('fotografia')->store('fotografia', 'public');
            $evento->save();
        }

        return back()->with(config('messages.mensaje_exito'));
        
    }

    public function update(Request $request)
    {
        $input = $request->all();

        $eventos = Eventos::find($input['id']);

        if($request->file('fotografia')){
            Storage::disk('public')->delete($eventos->fotografia);
        }

        $eventos->update([
            "id_usuario" => $input["id_usuario"],
            "nombre" => $input["nombre"],
            "descripcion" => $input["descripcion"],
            "ubicacion" => $input["ubicacion"],
            "fecha_evento" => $input["fecha_evento"],
            "capacidad" => $input["capacidad"],
            "registrados" => $input["registrados"],
            "status" => $input["status"],
        ]);

        if($request->file('fotografia')) {
            $eventos->fotografia = $request->file('fotografia')->store('fotografia', 'public');
            $eventos->save();
        }

        return back()->with(config('messages.mensaje_actualizar'));
    }

    public function destroy(Request $request, Eventos $eventos)
    {
        $eventos->delete();

        return back()->with(config('messages.mensaje_eliminar'));
    }
}
