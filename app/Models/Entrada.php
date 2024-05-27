<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Model\Alumno;

class Entrada extends Model
{
    use HasFactory;

    public function alumno()
    {
        return $this->belongsTo(Alumno::class, "uuid","uuid" );

    }
}
