<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Certificado de participação do evento: {{$evento->nome}}</title>
</head>
<body>
    <h1> Este certificado é concedido a {{$user->name}} por ter participado do evento: {{$evento->nome}}, realizado no dia {{ date('d/m/Y'), strtotime($evento->data)}} as {{$evento->horario}}.</h1>
</body>
</html>