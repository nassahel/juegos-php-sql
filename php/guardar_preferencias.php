<?php
session_start();
$ruta = '../';

if (!empty($_SESSION['usuario'])) {
    header("refresh:3;url=favoritos.php");
    require("encabezado.php");
    echo '<main class="container-fluid bg-verde justify-content-center align-items-center d-flex flex-grow-1 p-0">
    <article class="container text-center mt-5 p-3 bg-light rounded col-10 col-lg-4 pb-0"><p class="mb-4">Preferencias guardadas!</p> </article>
    </main>';
    $valor = $_POST['genero'];
    $nombre = $_SESSION['usuario'];
    $tiempo_exp = time() + 2 * 24 * 60 * 60;
    setcookie($nombre, $valor, $tiempo_exp, '/');
   
}
require("pie.php");
