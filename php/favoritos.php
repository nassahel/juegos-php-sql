<?php
session_start();
$ruta = '../';
require("encabezado.php");

if (!isset($_SESSION['usuario'])) {
    header("Location: ../index.php");
}

?>

<main class="container">
    <section class="row">
        <section class="col-3 menu pt-4">
            <?php require("menu.php"); ?>
        </section>
        <article class="col-9 listado pt-2">
            <h2 class="col-12 text-center bg-light py-4 ">FAVORITOS</h2>
            
            <?php
            require("conexion.php");
            $conexion = conectar();
            if ($conexion) {
                //consulta SQL para obtener los juegos
                $usuario = $_SESSION['usuario'];
                $generoCookie;
                if(!empty($_COOKIE[$usuario]) && isset($_COOKIE[$usuario])){
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
                        <section class="col-5 mt-2 mb-2">
                            <section class="card">
                                <img src="../img/portadas/<?php echo $portadaBD ?>" />

                                <section class="card-content p-3">
                                    <h4 class="card-title text-center"><?php echo $tituloBD ?></h4>
                                    <p class="">Jugadores: <?php echo $jugadoresBD ?></p>
                                    <p class="">Fecha de lanzamiento: <?php echo $lanzamientoBD ?></p>
                                    <p class="btn btn-primary"><?php echo $generoBD ?></p>
                                </section>
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
        </article>
    </section>
</main>

<?php
require("pie.php");
?>