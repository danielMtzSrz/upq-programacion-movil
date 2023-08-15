<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Eventos extends Model
{
    use HasFactory;

    protected $table = 'eventos';

    protected $fillable = [    
        "id_usuario",
        "nombre",
        "descripcion",
        "ubicacion",
        "fecha_evento",
        "capacidad",
        "registrados",
        "fotografia",
        "status",
    ];

    public function usuario(){
        return $this->belongsTo('App\Models\User');
    }
}
