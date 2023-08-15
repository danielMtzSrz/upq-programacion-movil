<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Eventos;
use App\Models\User;

use Inertia\Inertia;

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

        // Cargar imagen
        if($request->file('fotografia')){
            $evento->fotografia = $request->file('fotografia')->store('fotografia', 'public');
            $evento->save();
        }

        return back()->with(config('messages.mensaje_exito'));
        
    }

    public function update(Request $request, Eventos $eventos)
    {
        // dd($request->all());

        $input = $request->all();

        if($request->file('profile_photo_path')){
            Storage::disk('public')->delete($eventos->profile_photo_path);
        }

        $eventos->update([
            'apellido_paterno' => $input['apellido_paterno'],
            'apellido_materno' => $input['apellido_materno'],
            'name' => $input['name'],
            'edad' => $input['edad'],
            'sexo' => $input['sexo'],
            'estado_civil' => $input['estado_civil'],
            'estado_nacimiento' => $input['estado_nacimiento'],
            'nacionalidad' => $input['nacionalidad'],
            'pertenece_comunidad_indigena' => $input['pertenece_comunidad_indigena'],
            'comunidades_indigenas_pertenecientes' => $input['comunidades_indigenas_pertenecientes'],
            'habla_lengua_indigena' => $input['habla_lengua_indigena'],
            'lenguas_indigenas' => $input['lenguas_indigenas'],
            'tiene_discapacidad' => $input['tiene_discapacidad'],
            'discapacidades' => $input['discapacidades'],
            'ocupacion' => $input['ocupacion'],
            'lugar_asiste' => $input['lugar_asiste'],
            'cargo_puesto' => $input['cargo_puesto'],
            'telefono' => $input['telefono'],
            
            'email' => $input['email'],
            'password' => $input['password'] ? Hash::make($input['password']) : Hash::make('Temp123')
        ]);

        if($request->file('profile_photo_path')) {
            $eventos->profile_photo_path = $request->file('profile_photo_path')->store('profile_photo_path', 'public');
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
