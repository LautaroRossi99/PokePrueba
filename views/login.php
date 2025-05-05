<?php
session_start();

require_once ($_SERVER['DOCUMENT_ROOT'].'/PokedexPrueba/database.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/PokedexPrueba/Functions/functions.php');



?>


<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Pokedex</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background: url("../ImgLog/fondo2.jpg") no-repeat center center fixed;
            background-size: cover;
        }
        .login-card {
            background-color: transparent;
            backdrop-filter: blur(8px);
            border-radius: 15px;
        }
        .form-control::placeholder {
            color: #999;
            opacity: 1;
        }
        .input-group-text {
            background-color: #f1f1f1;
        }

    </style>
</head>
<body>
<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card login-card shadow p-4" style="width: 100%; max-width: 420px;">
        <h3 class="text-center mb-4 text-danger fw-bold d-flex justify-content-center align-items-center gap-2">
            <img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/items/poke-ball.png" alt="Pokebola" width="30">
            Iniciar Sesión
            <img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/items/poke-ball.png" alt="Pokebola" width="30">
        </h3>

        <form action="../Functions/function_login.php" method="post">
            <div class="mb-3 input-group">
                <span class="input-group-text"><i class="bi bi-person"></i></span>
                <input type="text" name="usuario" class="form-control" placeholder="Usuario" required>
            </div>

            <div class="mb-4 input-group">
                <span class="input-group-text"><i class="bi bi-lock"></i></span>
                <input type="password" name="contrasena" class="form-control" placeholder="Contraseña" required>
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-danger fw-bold">Ingresar</button>
                <a class="text-decoration-none text-white mt-2" href="/PokedexPrueba/index.php">Regresar al inicio</a>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>