<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body style="background-color:{{$fondo}}">
    <h1>Contacto</h1>
    
    @for($i=0;$i<$valores;$i++)
        @if (($i%2)==0)
            <h2 style="color:blue">{{$nombre}}</h2>
        @else
            <h2 style="color:red">{{$nombre}}</h2>
        @endif
    @endfor

</body>
</html>