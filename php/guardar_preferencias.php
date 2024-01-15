<?php
session_start();
$ruta = '../';

if (!empty($_SESSION['usuario'])) {
    header("refresh:3;url=favoritos.php");
    require("encabezado.php");
    echo '<article class="container text-center mt-5 p-3"><p class="mb-4">Preferencias Guardadas!</p> </article>';
    $valor = $_POST['genero'];
    $nombre = $_SESSION['usuario'];
    $tiempo_exp = time() + 2 * 24 * 60 * 60;
    setcookie($nombre, $valor, $tiempo_exp, '/');
   
}
require("pie.php");
