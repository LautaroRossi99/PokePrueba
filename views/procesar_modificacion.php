<?php

global $database;
require_once $_SERVER['DOCUMENT_ROOT'] . '/PokedexPrueba/database.php';


if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $numero = $_POST['numero_pokedex'];
    $nombre = $_POST['nombre'];
    $imagen = $_POST['imagen'];
    $descripcion = $_POST['descripcion'];
    $habitat = $_POST['habitat'];

    $stmt = $database->prepare("UPDATE pokemones SET numero_pokedex = ?,nombre = ?, imagen = ?, descripcion = ?, habitat = ? WHERE id = ? ");
    $stmt->bind_param("issssi", $numero, $nombre, $imagen, $descripcion, $habitat, $_POST['id']);
     $stmt->execute();

    if ($stmt->affected_rows > 0) {
        header("Location: ../index.php?modificado=ok");
    } else {
        header("Location: ../index.php?modificado=error");
    }
    exit;
}