<?php
session_start();
$ruta = '../';
require("encabezado.php");

if (!empty($_SESSION['usuario'])) {
    header("refresh:3;url=favoritos.php");
    echo '<article class="container text-center mt-5 p-3"><p class="mb-4">Preferencias Borradas!</p> </article>';
    $nombre = $_SESSION['usuario'];
    $tiempoExpiracion = time() - 100000;
    setcookie($nombre, '', $tiempoExpiracion, '/');
    unset($_COOKIE['nombre']);
  
}


require("pie.php");