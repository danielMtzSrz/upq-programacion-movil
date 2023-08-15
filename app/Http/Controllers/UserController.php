<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Spatie\Permission\Models\Role;

use Inertia\Inertia;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function index(Request $request)
    {

        $generos = config('staticdata.informacion_personal.generos');
        $tipos_sangre = config('staticdata.informacion_personal.tipos_sangre');
        $estados_civiles = config('staticdata.informacion_personal.estados_civiles');

        $users = User::all();

        return Inertia::render('Usuario/Index', compact('users', 'generos', 'tipos_sangre', 'estados_civiles'));
    }

    public function store(Request $request)
    {
        $input = $request->all();

        $user = User::create([
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

        // Cargar imagen
        if($request->file('profile_photo_path')){
            $user->profile_photo_path = $request->file('profile_photo_path')->store('profile_photo_path', 'public');
            $user->save();
        }

        // $user->roles()->sync($request->roles);

        return back()->with(config('messages.mensaje_exito'));
        
    }

    public function update(Request $request, User $user)
    {
        // $user->roles()->sync($request->roles);

        // dd($request->all());

        $input = $request->all();

        dd($input);

        if($request->file('profile_photo_path')){
            Storage::disk('public')->delete($user->profile_photo_path);
        }

        $user->update([
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
            $user->profile_photo_path = $request->file('profile_photo_path')->store('profile_photo_path', 'public');
            $user->save();
        }

        return back()->with(config('messages.mensaje_actualizar'));
    }

    public function destroy(Request $request, User $user)
    {
        $user->delete();

        return back()->with(config('messages.mensaje_eliminar'));
    }
}
