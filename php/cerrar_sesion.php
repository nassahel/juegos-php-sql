<?php
session_start();
$ruta = '../';
require("encabezado.php");

if (!empty($_SESSION['usuario'])) {
    echo '<article class="container text-center mt-5 p-3"><p class="mb-4">Cerrando sesión</p> </article>';
    session_destroy();  
    header("refresh:3;url=../index.php");
}


require("pie.php");
