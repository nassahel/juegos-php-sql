<?php
session_start();
$ruta = '../';
require("encabezado.php");
if (($_SESSION['tipo'] !== "Administrador")) {
    header("Location: ../index.php");
    exit();
}

include 'conexion.php';
$conexion = conectar();

if ($conexion && isset($_GET['id'])) {
    $id = $_GET['id'];
    $consulta = 'SELECT titulo, jugadores, lanzamiento, genero, portada FROM juego WHERE id_juego = ?';
    $sentencia = mysqli_prepare($conexion, $consulta);
    mysqli_stmt_bind_param($sentencia, 'i', $id);
    mysqli_stmt_execute($sentencia);
    mysqli_stmt_bind_result($sentencia, $titulo, $jugadores, $lanzamiento, $genero, $portada);
    mysqli_stmt_fetch($sentencia);

    if ($portada == '') {
        $portada = 'juego_default.png';
    } else {
        $portada = $portada;
    }

    desconectar($conexion);
}
?>

<main class="container">
    <section>
        <article>
            <section class="menu_tmp">
                <p>Opción: Juegos > Modificar</p>
            </section>
            <form action="juego_modificar_ok.php" method="post" enctype="multipart/form-data" class="bg-warning border-info">
                <legend class="bg-dark border-info text-center">Alta Juego</legend>
                <section>
                    <label for="titulo" class="form-label">Título</label>
                    <input type="text" name="titulo" id="titulo" value="<?php echo $titulo ?>" placeholder="Titulo" required maxlength="45" class="form-control border-warning">
                    <label for="jugadores" class="form-label">Jugadores</label>
                    <input type="number" name="jugadores" id="jugadores" value="<?php echo $jugadores ?>" placeholder="Jugadores" required maxlength="45" class="form-control border-warning">
                    <label for="lanzamiento" class="form-label">Lanzamiento</label>
                    <input type="date" name="lanzamiento" id="lanzamiento" value="<?php echo $lanzamiento ?>" required maxlength="45" class="form-control border-warning">
                    <label for="genero" value="<?php echo $titulo ?>" class="form-label">Genero</label>
                    <select name="genero" id="genero" class="form-select border-warning">
                        <option value="Rol">Rol</option>
                        <option value="Survival">Survival</option>
                        <option value="Estrategia">Estrategia</option>
                    </select>
                    <label for="portada" class="form-label">Portada</label>
                    <input type="file" name="portada" id="portada" class="form-control border-warning">
                    <input type="hidden" name="id" id="id" value="<?php echo $id ?>">
                    <input type="hidden" name="portadaActual" id="portadaActual" value="<?php echo $portada ?>">
                    <section class="text-center">
                        <input type="submit" name="enviar" value="Confirmar" class="btn btn-dark mt-3 mb-3">
                    </section>
                </section>
            </form>
        </article>
    </section>
</main>

<?php
require("pie.php");



?>