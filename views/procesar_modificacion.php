<?php

global $database;
require_once $_SERVER['DOCUMENT_ROOT'] . '/PokedexPrueba/database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $numero = $_POST['numero_pokedex'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $habitat = $_POST['habitat'];
    $imagen = isset($_FILES['imagen']) ? $_FILES['imagen'] : null;

    //tomamos la imagen actual de la BD
    $files = null;

    if ($imagen && $imagen['error'] === UPLOAD_ERR_OK) {
        $nombreLimpio = preg_replace("/[^a-zA-Z0-9\.-]/", "", $imagen['name']);
        $files = 'Pokemones/' . $nombreLimpio;
        $destino = '../' . $files;

        if (!move_uploaded_file($imagen['tmp_name'], $destino)) {
            echo "<div class='alert alert-danger mt-3'>❌ Error al subir el archivo.</div>";
            exit;
        }
    } else {
        // No se subió imagen nueva → buscamos la actual en la BD
        $stmt = $database->prepare("SELECT imagen FROM pokemones WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $row = $resultado->fetch_assoc();
        $files = $row['imagen']; // imagen actual
    }

    // Ahora actualizamos la base
    $stmt = $database->prepare("UPDATE pokemones SET numero_pokedex = ?, nombre = ?, imagen = ?, descripcion = ?, habitat = ? WHERE id = ?");
    $stmt->bind_param("issssi", $numero, $nombre, $files, $descripcion, $habitat, $id);
    $stmt->execute();

    if ($stmt->affected_rows >= 0) {
        // igual redireccionamos como éxito
        header("Location: ../index.php?modificado=ok");
        exit;
    }


    // Eliminar tipos actuales del Pokémon
    $stmt = $database->prepare("DELETE FROM pokemon_tipo WHERE pokemon_id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

// Insertar los tipos seleccionados (si hay)
    if (!empty($_POST['tipos'])) {
        $tipos = $_POST['tipos'];
        $stmt = $database->prepare("INSERT INTO pokemon_tipo (pokemon_id, tipo_id) VALUES (?, ?)");

        foreach ($tipos as $tipo_id) {
            $stmt->bind_param("ii", $id, $tipo_id);
            $stmt->execute();
        }
        exit;
    }
}
