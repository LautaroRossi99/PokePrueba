<?php
global $conn;
require("connection.php");

// Ruta a la carpeta donde tenés las imágenes
$carpetaImagenes = "Pokemones/";
$archivos = scandir($carpetaImagenes);

foreach ($archivos as $archivo) {
    // Evitar . y ..
    if ($archivo != "." && $archivo != "..") {
        // Obtener el nombre del archivo sin extensión
        $nombreSinExtension = pathinfo($archivo, PATHINFO_FILENAME);
        $rutaCompleta = $carpetaImagenes . $archivo;

        // Actualizar la tabla pokemones
        $sql = "UPDATE pokemones SET imagen = ? WHERE LOWER(nombre) = LOWER(?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $rutaCompleta, $nombreSinExtension);
        $stmt->execute();

        echo "Asignada imagen '$rutaCompleta' a '$nombreSinExtension' <br>";
    }
}
echo "¡Proceso completado!";
?>
