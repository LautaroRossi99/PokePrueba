<?php
global $database;
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/PokedexPrueba/database.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/PokedexPrueba/Functions/functions.php';



$user = obtenerUsuario($database);
$userIngresado = $_POST["usuario"];
$userContrasena = $_POST["contrasena"];

validarLogin($user, $userIngresado, $userContrasena);





?>