<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        "apellido_paterno",
        "apellido_materno",
        "name",
        "edad",
        "sexo",
        "estado_civil",
        "estado_nacimiento",
        "nacionalidad",
        "pertenece_comunidad_indigena",
        "comunidades_indigenas_pertenecientes",
        "habla_lengua_indigena",
        "lenguas_indigenas",
        "tiene_discapacidad",
        "discapacidades",
        "ocupacion",
        "lugar_asiste",
        "cargo_puesto",
        "telefono",
        "email",
        "password",
        "profile_photo_path"
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function setPasswordAttribute($value){
        $this->attributes["password"] = Hash::make($value);
    }

    public function eventos(){
        return $this->hasMany('App\Models\Eventos');
    }
}
