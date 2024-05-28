<table border="1">
    <tr>
        <th>Nombre</th>
        <th>Grupo</th>
    </tr>
    @php($cont=1)
@foreach($alumnos as $alumno)
    <tr>
        <td>
            {{$cont++}}
        </td>
        <td>
            {{$alumno->nombre}}
        </td>

        <td> 
            {{$alumno->grupo}}
        </td>

    </tr>


@endforeach
</table>

