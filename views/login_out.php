<?php

session_start();              // Iniciás la sesión
session_unset();              // Limpiás todas las variables de sesión
session_destroy();


// Eliminar la variable de sesión que contiene el nombre de usuario
unset($_SESSION['usuario']);

// También puedes destruir toda la sesión (opcional, si deseas cerrar toda la sesión y no solo una variable)
session_destroy();

// Redirigir a la página de login después de cerrar sesión
header("Location: ../views/login.php");
exit();

?>
