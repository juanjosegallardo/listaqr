<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Entrada;

class Alumno extends Model
{
    use HasFactory;

    public function entradas()
    {

        return $this->hasMany(Entrada::class,"uuid", "uuid");
    }

    public function scopeNombre($query, $nombre)
    {
        if($nombre)
        {
            //return $query->WhereRaw("MATCH(nombre) AGAINST('{$nombre}')");
            return $query->where("nombre", "like", "%{$nombre}%");
        }  
    }
}
