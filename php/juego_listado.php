<?php
session_start();
$ruta = '../';
require("encabezado.php");

if (empty($_SESSION['usuario'])) {
    header("Location: ../index.php");
}

?>

<main class="d-flex flex-grow-1 bg-beige">
    <section class="row col-12 px-0">
        <section class="col-2 menu pt-4">
            <?php require("menu.php"); ?>
        </section>
        <article class="col-8 mx-auto pt-2">
            <h2 class="col-12 text-center bg-dark text-white mb-4 py-4 ">TODOS LOS JUEGOS</h2>
            <section class="d-flex flex-row flex-wrap align-items-center gap-5">


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
                                <?php
                                if ($_SESSION['tipo'] == 'Administrador') {
                                ?>
                                    <section class="text-end mb-4 me-2">
                                        <a href="juego_modificar.php?id=<?php echo $id ?>" class="btn btn-primary bi-pen-fill"></a>
                                        <a href="juego_borrar.php?id=<?php echo $id ?>" class="btn btn-danger bi-trash-fill"></a>
                                    </section>
                                <?php
                                }
                                ?>

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