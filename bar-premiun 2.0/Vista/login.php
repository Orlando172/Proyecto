<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../Public/Css/login.css">
</head>
<body>
    <form action="../Controlador/ConL.php" method="post">
        <h1 class="animate__animated animate__backInLeft">Sistema de login</h1>
        <p>Usuario <input type="text" placeholder="Ingrese su usuario" name="usuario" required></p>
        <p>Contraseña <input type="password" placeholder="Ingrese su contraseña" name="contraseña" required></p>
        <p>Sede <input type="text" placeholder="Ingrese su sede" name="sede" required></p>
        <input type="submit" value="Ingresar" class="btn" name="Ingresar">
    </form> 
</body>
</html>
