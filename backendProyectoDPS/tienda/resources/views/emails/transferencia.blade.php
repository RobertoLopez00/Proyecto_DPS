<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h2>¡Gracias por tu compra!</h2>

    <p>Estimado/a {{ $venta->cliente->nombres}} {{ $venta->cliente->apellidos}},</p>

    <p>Tu pedido ha sido realizado con éxito. A continuación, te detallamos los productos que has adquirido:</p>

    <table>
        <thead>
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio unitario</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($venta->detalles as $item)
            <tr>
                <td>{{ $item->producto->producto }}</td>
                <td>{{ $item->cantidad }}</td>
                <td>{{ $item->producto->precio}}</td>
                <td>{{ $item->monto }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>   


    <p><strong>Total del pedido:</strong> {{ $venta->monto }}</p>

    <p>Tu compra se encuentra registrada, el envío se realizará cuando se realice la transferencia a la siguiente cuenta: 000000000</p>
    <p>Por favor enviar el comprobante de la transferencia al correo info@ininem.com</p>

    <p>En breve recibirás un correo electrónico con los detalles de envío.</p>

    <p>Gracias por tu confianza.</p>
    
</body>
</html>