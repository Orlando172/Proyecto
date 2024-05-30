<?php

$conexion = new mysqli("localhost","root","","bar-premiun");

    $conexion->set_charset("utf8");

    
$sql = "SELECT ID_P, nombre_P FROM producto";
$resultado = $this->conexion->query($sql);
if ($resultado->num_rows > 0) {
    echo "Productos encontrados: " . $resultado->num_rows . "<br>";
    while ($fila = $resultado->fetch_assoc()) {
        echo "ID: " . $fila['ID_P'] . ", Nombre: " . $fila['nombre_P'] . "<br>";
        $productos[] = $fila;
    }
} else {
    echo "No se encontraron productos.";
}
?>