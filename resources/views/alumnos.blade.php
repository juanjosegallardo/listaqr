<table>
asd
@foreach($alumnos as $alumno)
    <tr>
        <td>
            {{$alumno->nombre}}
        </td>

        <td>
            
            {{$alumno->uuid}}
        </td>
        <td>
          {!! QrCode::size(300)->generate($alumno->uuid) !!}
        </td>
    </tr>


@endforeach
</table>

