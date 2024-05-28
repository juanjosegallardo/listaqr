<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <title>Grupos</title>
    
    @vite(['resources/css/app.css', 'resources/js/concentrado.js'])
</head>
<body>

    <div class="container">


        <table class="table">
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
                <td ><a href="grupos/{{$grupo->grupo}}/alumnos"> <div id="td_{{$grupo->grupo}}_total"> {{$grupo->total}}</div>  </a></td>
                <td ><a href="grupos/{{$grupo->grupo}}/asistentes"><div id="td_{{$grupo->grupo}}_asistentes">{{$grupo->asistentes}}</div></a></td>
                <td ><a href="grupos/{{$grupo->grupo}}/faltantes"> <div id="td_{{$grupo->grupo}}_faltantes">{{$grupo->total - $grupo->asistentes}}</div> </a> </td>
            </tr>

            @endforeach


        </table>
    </div>
    


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

</body>
</html>

