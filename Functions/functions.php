<?php
define('RUTA_TIPOS', '/PokedexPrueba/Tipos/');
define('RUTA_POKEMONES', '/PokedexPrueba/');

// -------------------- INDEX --------------------

// Función para mostrar los datos de los pokemones
function mostrarDatosPokemon($coleccion)
{
    foreach ($coleccion as $pokemon) {
        // Card de pokemon

        echo '<div class="col-sm-6 col-md-4 col-lg-3 d-flex justify-content-center mb-4">';
        echo '<div class="card rounded card-pokemon">';
        echo '<div class="bg-danger  mb-2 rounded-top border-none">';
        echo '<h4 class="card-text mb-1" style="color:white; text-align:center;">' . $pokemon['nombre'] . '</h4>';
        echo '</div>';

        // Contenedor relativo para ubicar el número sobre la imagen
        echo '<div style="position: relative;">';
        echo '<img src="'.RUTA_POKEMONES . $pokemon['imagen'] . '" class="card-img-top" alt="..." style="height: 200px; object-fit: contain;">';
        echo '<span class="num-pokemon">#' . $pokemon['numero_pokedex'] . '</span>';
        echo '</div>';

        // Tipos y otros datos
        echo '<div class="card-body d-flex justify-content-between align-items-center">';
        echo '<div class="d-flex align-items-center">';
        mostrarElementoPokemon($pokemon['tipos']);
        echo '</div>';
        echo '<div>';
        echo '<form action="views/show_pokemon.php" method="get">
            <input type="hidden" name="pokemonVerMas" value="' . htmlspecialchars(json_encode($pokemon)) . '">
            <button type="submit" class="btn btn-danger btn-sm fw-bold shadow-sm rounded-pill px-3">Ver más</button>
            </form>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
}


function mostrarElementoPokemon($tipos){
    $tiposArray = explode(',', $tipos);  // Convertimos los tipos en un array

    foreach ($tiposArray as $tipo) {
        // Mostramos la imagen del tipo y el nombre del tipo dentro de la card
        echo "<img src='" . RUTA_TIPOS . "$tipo.png' alt='$tipo' width='30' style='margin-right:5px;'>";

    }
}

function mostrarNombreElementoPokemon($tipo){
    // Mostramos la imagen del tipo y el nombre del tipo dentro de la card
    echo "<h4>$tipo</h4>";
}


// -------------------- SHOW_POKEMON --------------------

function verificarSiExistePokemonElegido($pokemones, $pokemon) {
    $datosPokemon = [];
    $encontrado = false;

    foreach ($pokemones as $poke) {
        // Subcadena con cadena
        if (strpos(strtolower($poke['nombre']), $pokemon) !== false) {
            $datosPokemon[] = $poke;
            $encontrado = true;
        }
    }

    // Verifica si se encontro Poke
    if ($encontrado) {
        echo "<div class='container'>";

        $cantidadPokemones = count($datosPokemon); // Contamos cuántos pokemones hay

        // Definimos la clase de la columna
        $claseColumna = ($cantidadPokemones === 1) ? "col-12 col-md-8 " : "col-12 col-md-6";

        echo "<div class='row g-4 justify-content-center'>"; // justify-content-center para centrar si es uno solo

        foreach ($datosPokemon as $poke) {
            echo "<div class='$claseColumna d-flex'>"; // d-flex para que las cards tengan misma altura
            mostrarDatosPokemonEncontrado($poke);
            echo "</div>";
        }

        echo "</div>"; // Cerrar row
        echo "</div>"; // Cerrar container
    } else {
        echo "<h1> No se encontró el nombre de: $pokemon </h1>";
        mostrarDatosPokemon($pokemones);
    }
}

function mostrarDatosPokemonEncontrado($poke) {
    echo "<div class='card mb-3' style='border-radius: 15px; box-shadow: 0px 4px 10px rgba(0,0,0,0.1);'>";

    // Centrado vertical dentro de la tarjeta
    echo "<div class='row g-0 align-items-center' style='min-height: 220px;'>";

    // Columna de imagen centrada
    echo "<div class='col-md-4 d-flex justify-content-center'>";
    echo "<img src='../Pokemones/{$poke["nombre"]}.png' class='img-fluid rounded-start' style='height: 200px; object-fit: contain;'>";
    echo "</div>";

    // Columna de contenido
    echo "<div class='col-md-8'>";
    echo "<div class='card-body'>";

    echo "<h5 class='card-title fw-bold'>" . $poke["nombre"] . "</h5>";
    echo "<p class='card-text'>" . $poke["descripcion"] . "</p>";
    mostrarElementoPokemon($poke['tipos']);
    echo "<p class='card-text'><small class='text-muted'>" . $poke["habitat"] . "</small></p>";

    if (isset($_SESSION['usuario'])) {
        echo '<div class="d-flex justify-content-end gap-2 mt-2">';
        echo '<a href="modificar.php?id=' . $poke['id'] . '" class="btn btn-warning btn-sm fw-bold shadow-sm rounded-pill px-3">Modificar</a>';
        echo '<form action="../index.php" method="get" class="form-eliminar" data-pokemon-nombre="' . $poke['nombre'] . '">
              <input type="hidden" name="pokemonDelete" value="' . $poke["id"] . '">
                <button class="btn btn-danger btn-sm fw-bold shadow-sm rounded-pill px-3 text-decoration-none"> Eliminar </button>
              </form>';
        echo '</div>';
    }

    echo "</div>"; // card-body
    echo "</div>"; // col-md-8

    echo "</div>"; // row
    echo "</div>"; // card
}


// -------------------- VALIDAR_LOGIN --------------------
function validarLogin($usersDB, $userIngresado, $contrasenaIngresada) {
    foreach ($usersDB as $user) {
        $user_user = $user["usuario"];
        $user_password = $user["contrasena"];

        if ($user_user == $userIngresado && $user_password == $contrasenaIngresada) {
            $_SESSION['usuario'] = $user_user;
            header("Location: ../index.php");
            exit();
        }
    }

    echo "Usuario o contraseña incorrectos.";
}


?>