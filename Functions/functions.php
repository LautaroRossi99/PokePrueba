<?php

// -------------------- INDEX --------------------

// Función para mostrar los datos de los pokemones
function mostrarDatosPokemon($coleccion)
{
    foreach ($coleccion as $pokemon) {

        echo '<div class="col-sm-6 col-md-4 col-lg-3 d-flex justify-content-center mb-4">';
        echo '<div class="card rounded card-pokemon">';
        echo '<div class="bg-danger  mb-2 rounded-top border-none">';
        echo '<h4 class="card-text mb-1" style="color:white; text-align:center;">' . $pokemon['nombre'] . '</h4>';
        echo '</div>';

        // Contenedor relativo para ubicar el número sobre la imagen
        echo '<div style="position: relative;">';
        echo '<img src="' . $pokemon['imagen'] . '" class="card-img-top" alt="..." style="height: 200px; object-fit: contain;">';
        echo '<span class="num-pokemon">#' . $pokemon['numero_pokedex'] . '</span>';
        echo '</div>';

        // Tipos y otros datos
        echo '<div class="card-body d-flex justify-content-between">';
        echo '<div>';
        echo '<div class="d-flex gap-4 justify-content-center mb-3">';
        mostrarElementoPokemon($pokemon['tipos']);
        echo '</div>';
        echo '<a href="#" class="btn btn-danger btn-sm fw-bold shadow-sm rounded-pill px-3">Ver más</a>';
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
        echo "<img src='Tipos/$tipo.png' class='card-img-top img-element' alt='$tipo''>";
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
        foreach ($datosPokemon as $poke) {
            echo "<h1> Pokémon encontrado: " . $poke["nombre"] . "</h1>";
            mostrarDatosPokemonEncontrado($poke);
        }
    } else {
        echo "<h1> No se encontró el nombre de: $pokemon </h1> ";
        mostrarDatosPokemon($pokemones);
    }
}

function mostrarDatosPokemonEncontrado($poke) {
    echo "<h2> Datos del Pokemon:</h2>";
    echo "<h5> Nombre del pokemon: " . $poke["nombre"] . "</h5>";
    echo "<h4> Numero Pokedex: " . $poke["numero_pokedex"] . "</h4>";
    echo "<h4> Habitat: " . $poke["habitat"] . "</h4>";
    mostrarNombreElementoPokemon($poke["tipos"]);
    echo "<img src='Pokemones/{$poke["nombre"]}.png' class='card-img-top img-element'>";
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