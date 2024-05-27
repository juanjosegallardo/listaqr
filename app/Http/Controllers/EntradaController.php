<?php

namespace App\Http\Controllers;
use App\Models\Entrada;
use App\Models\Alumno;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class EntradaController extends Controller
{

    public function mostrarAsistentes()
    {

        $alumnos=  Alumno::whereHas('entradas')->get();

        return view("alumnos", ["alumnos"=>$alumnos]);
    }
    public function mostrarFaltantes()
    {
        $alumnos=  Alumno::doesntHave('entradas')->get();
        return view("alumnos", ["alumnos"=>$alumnos]);
    }

    public function mostrarAlumnos()
    {
        $alumnos =  Alumno::all();
        return view("alumnos", ["alumnos"=>$alumnos]);
    }

    public function asignarUUID()
    {
        $alumnosSinUUID = Alumno::where('uuid', "like", "")->get();

        foreach ($alumnosSinUUID as $alumno) {
            $alumno->uuid = Str::uuid();
            $alumno->save();
        }

        return "Asignados los UUID";
    }

    public function store(Request $request, $id)
    {  
        $alumno = Alumno::where("uuid", "like", $id)->first();
        $busqueda = Entrada::where("uuid","like",$id)->first();

 

        if($busqueda)
        {
            if($alumno)
            {
                return "Ya se registró una entrada con ese código, Alumno: {$alumno->nombre}";
            }

            return "Ya se registró una entrada con ese código, pero no se tiene registrado a ese alumno";
    
        
        }
        else
        {
            
            $entrada = new Entrada();
            $entrada->uuid  = $id;
            
            if($entrada->save())
            {

                $alumno = Alumno::where("uuid", "=", $id)->first();
                if($alumno)
                {
                    return "Entrada registrada, {$alumno->nombre}";
                }
                return "Entrada registrada pero no se encontro al alumno";
            }
            else
            {
                return "Ocurrio un error intente mas tarde";
            }
            

        }
        

    }
}
