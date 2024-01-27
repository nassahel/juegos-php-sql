<?php

if (!isset($_SESSION['usuario'])) {
    header("Location: ../index.php");
    exit();
}

if($_SESSION['foto'] == '' ){
    $fotoBD = 'usuario_default.png';
}else{
    $fotoBD = $_SESSION['foto'];
}

?>

<section class="border-bottom mb-2 pb-2">
    <!--Modificar la linea siguiente: agregue la foto, el nombre de usuario en el p y el enlace a la página de cerrar sesión-->

    <img src="../img/usuarios/<?php echo $fotoBD ?>" alt="">
    <p class="text-white"><?php echo $_SESSION['usuario'] ?></p> <a href="cerrar_sesion.php" class="btn btn-secondary border">cerrar sesión</a>
</section>
<ul class="navbar-nav text-center">
    <li class="nav-item bg-warning mb-2">
        <a href="juego_listado.php" class="nav-link bi-controller"> Listado Juegos</a>
    </li>
<!-- ------------------------- -->
     <?php
    if (($_SESSION['tipo'] == "Administrador")) {
     ?>

    <li class="nav-item bg-warning mb-2">
        <a href="usuario_alta.php" class="nav-link bi-person-plus-fill"> Alta de Usuario</a>
    </li>
    <li class="nav-item bg-warning mb-2">
        <a href="usuario_listado.php" class="nav-link bi-person-fill"> Listado Usuarios</a>
    </li>
    <li class="nav-item bg-warning mb-2">
        <a href="juego_alta.php" class="nav-link bi-patch-plus-fill"> Alta de Juego</a>
    </li>

    <?php } ?>
<!-- ---------------------------- -->
    <li class="nav-item bg-warning mb-2">
        <a href="preferencias.php" class="nav-link bi-gear-fill"> Preferencias</a>
    </li>
    <li class="nav-item bg-warning mb-2">
        <a href="favoritos.php" class="nav-link bi-star-fill"> Favoritos</a>
    </li>
    <!-- clases para los iconos de los menús que hay que agregar:
         Preferencias: bi-gear-fill
         Listar favoritos: bi-star-fill -->
</ul>