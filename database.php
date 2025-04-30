<?php

$config = parse_ini_file("config.ini");

// Conectarnos
$database = new MySqli($config["host"], $config["user"],$config["pass"],$config["db"]);

// Función para obtener todos los pokemones desde la base de datos
function obtenerPokemones($database)
{
$sql = "SELECT
p.id,
p.numero_pokedex,
p.nombre,
p.imagen,
p.descripcion,
p.habitat,
GROUP_CONCAT(t.elemento) AS tipos

FROM
pokemones p
LEFT JOIN
pokemon_tipo pt ON p.id = pt.pokemon_id
LEFT JOIN
tipo t ON pt.tipo_id = t.id
GROUP BY
p.id;
";

$result = $database->query($sql);
$pokemones = [];

for ($i = 0; $i < $result->num_rows; $i++) {
$fila = $result->fetch_assoc();
$pokemones[] = $fila;
}

return $pokemones;
}

function obtenerUsuario($database) {
    // Preparar la consulta SQL
    $stmt = $database->prepare("SELECT usuario, contrasena FROM USUARIOS");

    // Ejecutar la consulta
    $stmt->execute();

    // Obtener los resultados
    $result = $stmt->get_result();

    // Crear un arreglo de usuarios
    $users = [];
    while ($fila = $result->fetch_assoc()) {
        $users[] = $fila;
    }

    // Cerrar el statement
    $stmt->close();

    return $users;
}








?>