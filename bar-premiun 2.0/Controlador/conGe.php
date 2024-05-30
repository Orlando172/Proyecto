<?php
// Incluir el archivo de conexión a la base de datos
$conexion = new mysqli("localhost","root","","bar-premiun");

    $conexion->set_charset("utf8");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Manejar el envío del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["accion"])) {
    // Obtener los datos del formulario
    $mesa = $_POST["mesa"];
    $producto = $_POST["producto"];
    $cantidad = $_POST["cantidad"];
    $precio = $_POST["precio"];

    // Escapar los valores para prevenir inyección SQL
    $mesa = $conexion->real_escape_string($mesa);
    $producto = $conexion->real_escape_string($producto);
    $cantidad = $conexion->real_escape_string($cantidad);
    $precio = $conexion->real_escape_string($precio);

    // Preparar la consulta SQL para insertar un nuevo pedido
    $sql = "INSERT INTO gestionpedidos (mesa, producto, cantidad, precio) VALUES ('$mesa', '$producto', '$cantidad', '$precio')";

    // Ejecutar la consulta y verificar si se agregó correctamente el pedido
    if ($conexion->query($sql) === TRUE) {
        // Pedido agregado correctamente
        header("Location: ../Vista/gestion.php"); // Redirigir a la página de gestión de pedidos
        exit();
    } else {
        echo "Error al agregar el pedido: " . $conexion->error;
    }
}

function obtenerListaPedidos($conexion){
    $sql = "SELECT * FROM gestionpedidos";
    $resultado = $conexion->query($sql);
    $pedidos = [];

    if ($resultado->num_rows > 0) {
        while ($fila = $resultado->fetch_assoc()) {
            $pedidos[] = $fila;
        }
    }

    return $pedidos;
}
?>
