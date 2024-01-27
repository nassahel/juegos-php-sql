<?php
session_start();
$ruta = '../';
require("encabezado.php");

if (!isset($_SESSION['usuario'])) {
    header("Location: ../index.php");
}

?>

<main class="d-flex flex-grow-1 bg-beige">
    <section class="row col-12 px-0">
        <section class="col-2 menu pt-4">
            <?php require("menu.php"); ?>
        </section>
        <article class="col-8 mx-auto pt-2">
            <h2 class="col-12 text-center bg-dark text-white mb-4 py-4 ">FAVORITOS</h2>
            <section class="d-flex flex-row flex-wrap align-items-center gap-5">

                <?php
                require("conexion.php");
                $conexion = conectar();
                if ($conexion) {
                    //consulta SQL para obtener los juegos
                    $usuario = $_SESSION['usuario'];
                    $generoCookie;
                    if (!empty($_COOKIE[$usuario]) && isset($_COOKIE[$usuario])) {
                        $generoCookie =  $_COOKIE[$usuario];
                    }
                    $consulta = 'SELECT titulo, jugadores, lanzamiento, genero, portada FROM juego WHERE genero = ? ';
                    $sentencia = mysqli_prepare($conexion, $consulta);
                    mysqli_stmt_bind_param($sentencia, 's', $generoCookie);
                    mysqli_stmt_execute($sentencia);
                    mysqli_stmt_bind_result($sentencia, $tituloBD, $jugadoresBD, $lanzamientoBD, $generoBD, $portadaBD);
                    mysqli_stmt_store_result($sentencia);
                    $cantidad = mysqli_stmt_num_rows($sentencia);

                    if ($cantidad > 0) {
                        while (mysqli_stmt_fetch($sentencia)) {
                            $portadaBD == '' ? $portadaBD = 'portada_default.png' : $portadaBD = $portadaBD;
                ?>
                            <section class="card overflow-hidden" style="width: 22rem; height: 27rem">
                                <figure class="h-50 d-flex justify-content-center">
                                    <img src="../img/portadas/<?php echo $portadaBD ?>" class="object-fit-scale w-100" />
                                </figure>
                                <section class="card-content px-3">
                                    <h4 class="card-title text-center"><?php echo $tituloBD ?></h4>
                                    <p class="mb-1">Jugadores: <?php echo $jugadoresBD ?></p>
                                    <p class="">Fecha de lanzamiento: <?php echo $lanzamientoBD ?></p>
                                    <p class="btn btn-primary"><?php echo $generoBD ?></p>
                                    <a href="" class="btn btn-success bi-cart-plus mb-3"></a>
                                </section>
                            </section>
                <?php
                        }
                    } else {
                        echo '<h2>No hay resultados</h2>';
                    }
                    desconectar($conexion);
                }
                ?>
            </section>
        </article>
</main>

<?php
require("pie.php");
?>