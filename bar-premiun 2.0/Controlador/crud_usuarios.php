<?php
include "../Conexion/conexion.php";

function obtenerUsuarios() {
    global $conexion;
    $sql = "SELECT * FROM usuario";
    $resultado = $conexion->query($sql);
    $usuarios = [];

    if ($resultado->num_rows > 0) {
        while ($fila = $resultado->fetch_assoc()) {
            $usuarios[] = $fila;
        }
    }

    return $usuarios;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["accion"])) {
    $accion = $_POST["accion"];
    $ID_U = isset($_POST["ID_U"]) ? $_POST["ID_U"] : null;
    $cargo = isset($_POST["cargo"]) ? $_POST["cargo"] : null;
    $nombre_U = isset($_POST["nombre_U"]) ? $_POST["nombre_U"] : null;
    $telefono = isset($_POST["telefono"]) ? $_POST["telefono"] : null;
    $sede = isset($_POST["sede"]) ? $_POST["sede"] : null;
    $usuario = isset($_POST["usuario"]) ? $_POST["usuario"] : null;
    $pass = isset($_POST["pass"]) ? password_hash($_POST["pass"], PASSWORD_DEFAULT) : null;

    if ($accion == "crear") {
        $stmt = $conexion->prepare("INSERT INTO usuario (cargo, nombre_U, telefono, sede, usuario, pass) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $cargo, $nombre_U, $telefono, $sede, $usuario, $pass);
        $stmt->execute();
        $stmt->close();
    } elseif ($accion == "actualizar") {
        $stmt = $conexion->prepare("UPDATE usuario SET cargo = ?, nombre_U = ?, telefono = ?, sede = ?, usuario = ?, pass = ? WHERE ID_U = ?");
        $stmt->bind_param("ssssssi", $cargo, $nombre_U, $telefono, $sede, $usuario, $pass, $ID_U);
        $stmt->execute();
        $stmt->close();
    } elseif ($accion == "eliminar") {
        $stmt = $conexion->prepare("DELETE FROM usuario WHERE ID_U = ?");
        $stmt->bind_param("i", $ID_U);
        $stmt->execute();
        $stmt->close();
    } elseif ($accion == "editar") {
        $stmt = $conexion->prepare("SELECT * FROM usuario WHERE ID_U = ?");
        $stmt->bind_param("i", $ID_U);
        $stmt->execute();
        $resultado = $stmt->get_result();
        if ($resultado->num_rows > 0) {
            $usuario = $resultado->fetch_assoc();
            echo "<script>
                document.getElementById('user-id').value = '" . $usuario['ID_U'] . "';
                document.getElementById('cargo').value = '" . $usuario['cargo'] . "';
                document.getElementById('nombre_U').value = '" . $usuario['nombre_U'] . "';
                document.getElementById('telefono').value = '" . $usuario['telefono'] . "';
                document.getElementById('sede').value = '" . $usuario['sede'] . "';
                document.getElementById('usuario').value = '" . $usuario['usuario'] . "';
            </script>";
        }
        $stmt->close();
    }
    header("Location: ../Vista/usuario.php"); // Corregido el destino de la redirección
    exit();
}
?>
