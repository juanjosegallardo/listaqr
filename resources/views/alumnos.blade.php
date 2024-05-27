<table border="1">
@foreach($alumnos as $alumno)
    <tr>
        <td>
            {{$alumno->nombre}}
        </td>

        <td>
            
            {{$alumno->uuid}}
        </td>

        <td> 
            {{$alumno->grupo}}
        </td>

    </tr>


@endforeach
</table>

