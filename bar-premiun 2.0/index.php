<?php
// Verificar que no haya salida antes del header()
ob_start();

// Redirigir a login.php
header("Location:../bar-premiun 2.0/Vista/login.php");
exit();

// Finalizar el buffer de salida y limpiar
ob_end_clean();
?>
