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
                echo 'Bienvenido, ' . $_SESSION['usuario'] . ' 
          <a href="/PokedexPrueba/views/login_out.php" class="text-white">Cerrar sesión</a>';
            } else {
                echo '<a href="/PokedexPrueba/views/login.php" class="text-white text-decoration-none">Iniciar sesión</a>';
            }

            ?>
        </div>
    </div>
</nav>

