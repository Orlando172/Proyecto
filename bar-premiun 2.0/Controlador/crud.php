<?php
include("../Conexion/conexion.php");

function obtenerProductos() {
    global $conexion;
    $sql = "SELECT * FROM producto";
    $resultado = $conexion->query($sql);
    $productos = [];

    if ($resultado->num_rows > 0) {
        while ($fila = $resultado->fetch_assoc()) {
            $productos[] = $fila;
        }
    }

    return $productos;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["accion"])) {
    $accion = $_POST["accion"];
    $id = isset($_POST["ID_P"]) ? $_POST["ID_P"] : null;
    $nombre = isset($_POST["nombre_P"]) ? $_POST["nombre_P"] : null;
    $cantidad = isset($_POST["cantidad_P"]) ? $_POST["cantidad_P"] : null;
    $sede = isset($_POST["sede"]) ? $_POST["sede"] : null;

    // Validar que los campos obligatorios no sean nulos
    if ($accion != "eliminar" && (is_null($nombre) || is_null($cantidad) || is_null($sede))) {
        die("Error: Todos los campos (excepto ID) son obligatorios.");
    }

    if ($accion == "crear") {
        $stmt = $conexion->prepare("INSERT INTO producto (nombre_P, cantidad_P, Sede) VALUES (?, ?, ?)");
        if (!$stmt) {
            die("La preparación falló: (" . $conexion->errno . ") " . $conexion->error);
        }
        $stmt->bind_param("sis", $nombre, $cantidad, $sede);
        if (!$stmt->execute()) {
            die("La ejecución de la consulta de inserción falló: (" . $stmt->errno . ") " . $stmt->error);
        }
        $stmt->close();
    } elseif ($accion == "actualizar") {
        if (is_null($id)) {
            die("Error: El ID es obligatorio para actualizar.");
        }
        $stmt = $conexion->prepare("UPDATE producto SET nombre_P = ?, cantidad_P = ?, Sede = ? WHERE ID_P = ?");
        if (!$stmt) {
            die("La preparación falló: (" . $conexion->errno . ") " . $conexion->error);
        }
        $stmt->bind_param("sisi", $nombre, $cantidad, $sede, $id);
        if (!$stmt->execute()) {
            die("La ejecución de la consulta de actualización falló: (" . $stmt->errno . ") " . $stmt->error);
        }
        $stmt->close();
    } elseif ($accion == "eliminar") {
        if (is_null($id)) {
            die("Error: El ID es obligatorio para eliminar.");
        }
        $stmt = $conexion->prepare("DELETE FROM producto WHERE ID_P = ?");
        if (!$stmt) {
            die("La preparación falló: (" . $conexion->errno . ") " . $conexion->error);
        }
        $stmt->bind_param("i", $id);
        if (!$stmt->execute()) {
            die("La ejecución de la consulta de eliminación falló: (" . $stmt->errno . ") " . $stmt->error);
        }
        $stmt->close();
    }

    // Redirigir después de realizar una operación que modifique los datos
    header("Location: ../Vista/producto.php");
    exit();
}
?>
