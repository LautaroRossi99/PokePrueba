<nav class="navbar navbar-expand-lg navbar-dark bg-danger px-4">
    <div class="container-fluid d-flex justify-content-between align-items-center w-100">
        <!-- 🔵 Logo Pokémon a la izquierda -->
        <div>
            <img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/items/poke-ball.png" alt="Pokeball" width="40" height="40" class="me-2">
        </div>
        <!-- 🟥 Texto centrado -->
        <div class="mx-auto text-white fw-bold fs-4">
            <a class="text-white text-decoration-none" href="/PokedexPrueba/index.php">POKEDEX</a>
        </div>

        <div class="text-white">
            <?php
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            if (isset($_SESSION['usuario'])) {
                echo '
    <div class="dropdown animate__pulse">
        <button class="btn btn-secondary dropdown-toggle btn-drop" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            Bienvenido, ' . $_SESSION['usuario'] . '
        </button>
        <ul class="dropdown-menu dropdown-menu-dark">
            <li><a class="dropdown-item" href="/PokedexPrueba/index.php">Inicio</a></li>

            <li><a class="dropdown-item" href="/PokedexPrueba/views/create_pokemon.php">Crear Pokémon</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="/PokedexPrueba/views/login_out.php">Cerrar sesión</a></li>
        </ul>
    </div>';
            } else {
                echo '<a href="/PokedexPrueba/views/login.php" class="text-white text-decoration-none">Iniciar sesión</a>';
            }
            ?>
        </div>
    </div>
</nav>

