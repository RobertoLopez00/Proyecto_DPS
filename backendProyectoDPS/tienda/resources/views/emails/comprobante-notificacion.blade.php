<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h2>Entrega de Comprobante</h2>
    <p>El usuario {{$venta->cliente->nombres}} {{$venta->cliente->apellidos}} con el número de venta {{$venta->id}} ha subido un comprobante, revisar validez del mismo en el apartado ventas del sistema administrativo</p>
    
</body>
</html>