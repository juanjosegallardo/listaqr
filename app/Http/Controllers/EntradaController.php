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

        $alumnos=  Alumno::whereHas('entradas')->orderBy("nombre")->get();

        return view("alumnos", ["alumnos"=>$alumnos]);
    }
    public function mostrarFaltantes()
    {
        $alumnos=  Alumno::doesntHave('entradas')->orderBy("nombre")->get();
        return view("alumnos", ["alumnos"=>$alumnos]);
    }


    public function mostrarAsistentesGrupo($id)
    {

        $alumnos=  Alumno::whereHas('entradas')->where("grupo","=",$id)->orderBy("nombre")->get();

        return view("alumnos", ["alumnos"=>$alumnos]);
    }
    public function mostrarFaltantesGrupo($id)
    {
        $alumnos=  Alumno::doesntHave('entradas')->where("grupo","=",$id)->orderBy("nombre")->get();
        return view("alumnos", ["alumnos"=>$alumnos]);
    }

    public function obtenerGrupos()
    {
        $grupos = Alumno::select('grupo', DB::raw('count(alumnos.uuid) as total'), DB::raw('count(entradas.uuid) as asistentes'))
                        ->leftJoin('entradas', 'alumnos.uuid', '=', 'entradas.uuid')
                        ->groupBy('grupo')
                        ->get();

        return response()->json($grupos);
   
    }

    public function mostrarGrupos()
    {
        $grupos = Alumno::select('grupo', DB::raw('count(alumnos.uuid) as total'), DB::raw('count(entradas.uuid) as asistentes'))
                        ->leftJoin('entradas', 'alumnos.uuid', '=', 'entradas.uuid')
                        ->groupBy('grupo')
                        ->get();

        return view("grupos", ["grupos"=>$grupos]);
   
    }



    
    public function mostrarAlumnosGrupo($id)
    {
        $alumnos=  Alumno::where("grupo","=",$id)->orderBy("nombre")->get();

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
                return response()->json( [  
                    "mensaje" => "Ya se registró una entrada con ese código, Alumno: {$alumno->nombre}",
                    "encontrado" => true,
                    "guardado"=>false,
                    "grupo"=> $alumno->grupo
                ]);
            }

            return response()->json( [  
                "mensaje" => "Ya se registró una entrada con ese código, pero no se tiene registrado a ese alumno",
                "encontrado" => false,
                "guardado"=>false,
                "grupo"=> $alumno->grupo
            ]);
           
    
        
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
                    return response()->json( [  
                        "mensaje" => "Entrada registrada, {$alumno->nombre}",
                        "encontrado" => true,
                        "guardado"=>true,
                        "grupo"=>$alumno->grupo
                    ]);
                }
                return response()->json( [  
                    "mensaje" => "Entrada registrada pero no se encontro al alumno",
                    "encontrado" => false,
                    "guardado"=>false,
                    "grupo"=>""
                ]);
               
                
            }
            else
            {
                return response()->json( [  
                    "mensaje" => "Ocurrió un error, intente mas tarde",
                    "encontrado" => false,
                    "guardado"=>false
                ]);
               
            }
            

        }
        

    }
}
