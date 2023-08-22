<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    

    <form action="/personas" method="post">
        @csrf
        Nombre: <input type="text" name="nombre" id=""> <br>
        Apellido: <input type="text" name="apellido" id=""> <br>
        Email: <input type="email" name="email" id=""> <br><br>

        Telefono: <input type="text" name="telefono" id=""> <br>
        Otro Telefono: <input type="text" name="otroTelefono" id=""> <br>

        <input type="submit" value="Enviar">

    </form>
</body>
</html>