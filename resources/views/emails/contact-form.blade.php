<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact Form Submission</title>
</head>
<body>
    <h1 style="color:red">Nuevo mensaje de contacto</h1>
    <p><strong>Nombre:</strong> {{ $data['name'] }}</p>
    <p><strong>Correo electrónico:</strong> {{ $data['email'] }}</p>
    <p><strong>Número de teléfono:</strong> {{ $data['phone_number'] }}</p>
    <p><strong>Asunto:</strong> {{ $data['affair'] }}</p>
    <p><strong>Mensaje:</strong> {{ $data['message'] }}</p>
</body>
</html>
