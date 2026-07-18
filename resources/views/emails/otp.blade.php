<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Código de verificación</title>
</head>
<body>
    <p>Hola {{ $user->name }},</p>

    <p>Tu código de verificación es:</p>

    <h2>{{ $otp }}</h2>

    <p>Este código es válido durante 5 minutos.</p>

    <p>Si no intentaste iniciar sesión, puedes ignorar este mensaje.</p>
</body>
</html>
