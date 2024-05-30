<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD de Usuarios</title>
    <link rel="stylesheet" href="../Public/Css/usuario.css">
    <script>
        function llenarCamposUsuario(idUsuario, cargo, nombre, telefono, sede, usuario) {
            document.getElementById('user-id').value = idUsuario;
            document.getElementById('cargo').value = cargo;
            document.getElementById('nombre_U').value = nombre;
            document.getElementById('telefono').value = telefono;
            document.getElementById('sede').value = sede;
            document.getElementById('usuario').value = usuario;
        }
    </script>
</head>
<body>
    <header>
        <nav>
            <div class="logo">Gestión de Usuarios</div>
            <ul>
                <li><a href="gestion.php">Gestión</a></li>
                <li><a href="usuario.php">Crear Usuario</a></li>
                <li><a href="producto.php">Ingresar Producto</a></li>
                <li><a href="menu.php" class="button">Menú Principal</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <form action="../Controlador/crud_usuarios.php" method="POST" class="user-form">
            <input type="hidden" name="ID_U" id="user-id">
            <label for="cargo">Cargo:</label>
            <input type="text" name="cargo" id="cargo" required>
            <label for="nombre_U">Nombre:</label>
            <input type="text" name="nombre_U" id="nombre_U" required>
            <label for="telefono">Teléfono:</label>
            <input type="text" name="telefono" id="telefono" required>
            <label for="sede">Sede:</label>
            <input type="text" name="sede" id="sede" required>
            <label for="usuario">Usuario:</label>
            <input type="text" name="usuario" id="usuario" required>
            <label for="pass">Contraseña:</label>
            <input type="password" name="pass" id="pass" required>
            <button type="submit" name="accion" value="crear">Crear</button>
            <button type="submit" name="accion" value="actualizar">Actualizar</button>
        </form>

        <h2>Lista de Usuarios</h2>
        <table>
            <thead>
                <tr>
                    <th>Cargo</th>
                    <th>Nombre</th>
                    <th>Teléfono</th>
                    <th>Sede</th>
                    <th>Usuario</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include "../Controlador/crud_usuarios.php";
                $usuarios = obtenerUsuarios();
                foreach ($usuarios as $usuario) {
                    echo "<tr onclick=\"llenarCamposUsuario(" . $usuario['ID_U'] . ", '" . htmlspecialchars($usuario['cargo'], ENT_QUOTES, 'UTF-8') . "', '" . htmlspecialchars($usuario['nombre_U'], ENT_QUOTES, 'UTF-8') . "', '" . htmlspecialchars($usuario['telefono'], ENT_QUOTES, 'UTF-8') . "', '" . htmlspecialchars($usuario['sede'], ENT_QUOTES, 'UTF-8') . "', '" . htmlspecialchars($usuario['usuario'], ENT_QUOTES, 'UTF-8') . "')\">";
                    echo "<td>" . htmlspecialchars($usuario['cargo'], ENT_QUOTES, 'UTF-8') . "</td>";
                    echo "<td>" . htmlspecialchars($usuario['nombre_U'], ENT_QUOTES, 'UTF-8') . "</td>";
                    echo "<td>" . htmlspecialchars($usuario['telefono'], ENT_QUOTES, 'UTF-8') . "</td>";
                    echo "<td>" . htmlspecialchars($usuario['sede'], ENT_QUOTES, 'UTF-8') . "</td>";
                    echo "<td>" . htmlspecialchars($usuario['usuario'], ENT_QUOTES, 'UTF-8') . "</td>";
                    echo "<td>
                            <form action='../Controlador/crud_usuarios.php' method='POST' style='display:inline-block;'>
                                <input type='hidden' name='ID_U' value='" . $usuario['ID_U'] . "'>
                                <button type='submit' name='accion' value='editar'>Editar</button>
                            </form>
                            <form action='../Controlador/crud_usuarios.php' method='POST' style='display:inline-block;' onsubmit='return confirmarEliminar()'>
                                <input type='hidden' name='ID_U' value='" . $usuario['ID_U'] . "'>
                                <button type='submit' name='accion' value='eliminar'>Eliminar</button>
                            </form>
                          </td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </main>
</body>
</html>
