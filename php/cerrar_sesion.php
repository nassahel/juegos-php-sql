<?php
session_start();
$ruta = '../';
require("encabezado.php");

if (!empty($_SESSION['usuario'])) {
    echo '<main class="container-fluid bg-verde justify-content-center align-items-center d-flex flex-grow-1 p-0">
    <article class="container text-center mt-5 p-3 bg-light rounded col-10 col-lg-4 pb-0"><p class="mb-4">Cerrando sesión...</p> </article>
    </main>';
    session_destroy();  
    header("refresh:3;url=../index.php");
}


require("pie.php");
