<?php
include("../Conexion/conexion.php");

if(!empty($_POST["Ingresar"])){
    if(empty($_POST["usuario"]) || empty($_POST["contraseña"]) || empty($_POST["sede"])){
        echo '<div class="alert alert-danger">Por favor, complete todos los campos</div>';
    } else {
        $usuario = $_POST["usuario"];
        $contraseña = $_POST["contraseña"];
        $sede = $_POST["sede"];
        
        // Usar prepared statements para prevenir inyecciones SQL
        $stmt = $conexion->prepare("SELECT * FROM login WHERE usuario = ? AND pass = ? AND sede = ?");
        $stmt->bind_param("sss", $usuario, $contraseña, $sede);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if($result->num_rows > 0){
            // Autenticación exitosa
            $usuario_data = $result->fetch_assoc();
            if($usuario_data['cargo'] == 'admin'){
                // Redirigir al administrador a su página
                header("location:../Vista/menu.php");
                exit();
            } else {
                // Redirigir al empleado a su página
                header("location:../Vista/gestion.php");
                exit();
            }
        } else {
            echo '<div class="alert alert-danger">ACCESO DENEGADO</div>';
        }

        $stmt->close();
    }
}
?>
