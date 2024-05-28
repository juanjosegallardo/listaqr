<table border="1">
    <tr>
        <th>Nombre</th>
        <th>Grupo</th>
    </tr>
@foreach($alumnos as $alumno)
    <tr>
        <td>
            {{$alumno->nombre}}
        </td>

        <td> 
            {{$alumno->grupo}}
        </td>

    </tr>


@endforeach
</table>

