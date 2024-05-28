<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/js/concentrado.js'])
</head>
<body>
    
</body>
</html>

<table border="1">
    <tr>
        <th>Grupo</th>
        <th>Alumnos</th>
        <th>Asistentes</th>
        <th>Faltantes</th>
    </tr>
    @php($total=0)


    @foreach($grupos as $grupo)
    @php($total+=$grupo->total)    
    <tr>
        <td >{{$grupo->grupo}}</td>
        <td id="td_{{$grupo->grupo}}_total">{{$grupo->total}}</td>
        <td id="td_{{$grupo->grupo}}_asistentes">{{$grupo->asistentes}}</td>
        <td id="td_{{$grupo->grupo}}_faltantes">{{$grupo->total - $grupo->asistentes}} </td>
    </tr>

    @endforeach


</table>