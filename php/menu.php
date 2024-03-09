<?php

if (!isset($_SESSION['usuario'])) {
    header("Location: ../index.php");
    exit();
}



if ($_SESSION['foto'] == '') {
    $fotoBD = 'usuario_default.png';
} else {
    $fotoBD = $_SESSION['foto'];
}
?>



<section class="border-bottom mb-2 pb-2">
    <img src="../img/usuarios/<?php echo $fotoBD ?>" alt="" class="rounded">
    <div class="text-center ms-4">
        <p class="fw-bold text-uppercase mb-2"><?php echo $_SESSION['usuario'] ?></p>
        <a href="cerrar_sesion.php" class="btn btn-success border">cerrar sesión</a>
    </div>
</section>

<ul class="navbar-nav d-flex flex-row flex-wrap gap-2 justify-content-center align-center text-center ps-2">
    <li class="nav-item mb-2 col-5 col-md-11 px-1 rounded">
        <a href="juego_listado.php" class="nav-link bi-controller"> Listado Juegos</a>
    </li>
    <?php
    if (($_SESSION['tipo'] == "Administrador")) {
    ?>

        <li class="nav-item mb-2 col-5 col-md-11 px-1 rounded">
            <a href="usuario_alta.php" class="nav-link bi-person-plus-fill"> Alta de Usuario</a>
        </li>

        <li class="nav-item mb-2 col-5 col-md-11 px-1 rounded">
            <a href="usuario_listado.php" class="nav-link bi-person-fill"> Listado Usuarios</a>
        </li>

        <li class="nav-item mb-2 col-5 col-md-11 px-1 rounded">
            <a href="juego_alta.php" class="nav-link bi-patch-plus-fill"> Alta de Juego</a>
        </li>
    <?php } ?>

    <!-- ---------------------------- -->

    <li class="nav-item mb-2 col-5 col-md-11 px-1 rounded">
        <a href="preferencias.php" class="nav-link bi-gear-fill"> Preferencias</a>
    </li>

    <li class="nav-item mb-2 col-5 col-md-11 px-1 rounded">
        <a href="favoritos.php" class="nav-link bi-star-fill"> Favoritos</a>
    </li>
</ul>