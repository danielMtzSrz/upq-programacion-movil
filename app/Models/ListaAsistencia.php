<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListaAsistencia extends Model
{
    use HasFactory;

    protected $table = 'listaasistencia';

    protected $fillable = [    
        "id_usuario",
        "id_evento"
    ];

    public function eventos(){
        return $this->hasMany('App\Models\Eventos');
    }

    public function usuarios(){
        return $this->hasMany('App\Models\User');
    }
}
