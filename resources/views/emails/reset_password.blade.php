<!DOCTYPE html>
<html>
<head>
    <title>Restablecer Contraseña</title>
</head>
<body>
    <h1>Solicitud para restablecer contraseña</h1>
    <p>Haz clic en el siguiente enlace para restablecer tu contraseña:</p>
    <a href="{{('http://localhost:4200/reset-password?token=' . $token) }}">Restablecer Contraseña</a>
    <p>Si no solicitaste esto, simplemente ignora este correo.</p>
</body>
</html>
