<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

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
            'password' => $input['password'],
        ]);

        if($input['profile_photo_path']){
            $user->profile_photo_path = $input['profile_photo_path']->store('profile_photo_path', 'public');
            $user->save();
        }


        return $user;
    }
}
