<?php
session_start();
$ruta = '../';
require("encabezado.php");

if (empty($_SESSION['usuario'])) {
    header("Location: ../index.php");
}

?>

<main class="container">
    <section class="row">
        <section class="col-3 menu pt-4">
            <?php require("menu.php"); ?>
        </section>
        <article class="col-9 listado pt-2">
        <h2 class="col-12 text-center bg-light py-4 ">TODOS LOS JUEGOS</h2>
            <?php
            require("conexion.php");
            $conexion = conectar();
            if ($conexion) {
                //consulta SQL para obtener los juegos
                $consulta = 'SELECT id_juego, titulo, jugadores, lanzamiento, genero, portada FROM juego';
                $sentencia = mysqli_prepare($conexion, $consulta);
                mysqli_stmt_execute($sentencia);
                mysqli_stmt_bind_result($sentencia, $id, $tituloBD, $jugadoresBD, $lanzamientoBD, $generoBD, $portadaBD);
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
                                    <a href="" class="btn btn-success bi-cart-plus mb-3"></a>
                                </section>

                                <?php 
                                if($_SESSION['tipo'] == 'Administrador'){
                                ?>
                                <section class="text-end mb-4 me-2">
                                    <a href="juego_modificar.php?id=<?php echo $id ?>" class="btn btn-primary bi-pen-fill"></a>
                                    <a href="juego_borrar.php?id=<?php echo $id ?>" class="btn btn-danger bi-trash-fill"></a>
                                </section>
                                <?php 
                                }
                                ?>

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