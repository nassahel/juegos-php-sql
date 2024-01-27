<?php
session_start();
$ruta = '../';
require("encabezado.php");
if (($_SESSION['tipo'] !== "Administrador")) {
    header("Location: ../index.php");
    exit();
}
?>

<main class="container-fluid bg-beige d-flex flex-grow-1">
     <article class="container-fluid">
            <section class="menu_tmp">
                <p>Opción: Juegos > Alta</p>
            </section>
            <form action="juego_alta_ok.php" method="post" enctype="multipart/form-data" class="bg-warning border-info col-11 col-md-6 col-lg-6 col-xl-3">
                <legend class="bg-dark border-info text-center">Alta Juego</legend>
                <section>
                    <label for="titulo" class="form-label">Título</label>
                    <input type="text" name="titulo" id="titulo" placeholder="Titulo" required maxlength="45" class="form-control border-warning">
                    <label for="jugadores" class="form-label">Jugadores</label>
                    <input type="number" name="jugadores" id="jugadores" placeholder="Jugadores" required maxlength="45" class="form-control border-warning">
                    <label for="lanzamiento" class="form-label">Lanzamiento</label>
                    <input type="date" name="lanzamiento" id="lanzamiento"  required maxlength="45" class="form-control border-warning">
                    <label for="genero" class="form-label">Genero</label>
                    <select name="genero" id="genero" class="form-select border-warning">
                        <option value="Rol">Rol</option>
                        <option value="Survival">Survival</option>
                        <option value="Estrategia">Estrategia</option>
                    </select>
                    <label for="portada" class="form-label">Portada</label>
                    <input type="file" name="portada" id="portada" class="form-control border-warning">
                    <section class="text-center">
                        <a class="btn btn-dark" href="juego_listado.php"> < Volver</a>
                        <input type="submit" name="enviar" value="Confirmar" class="btn btn-dark mt-3 mb-3">
                    </section>
                </section>
            </form>
        </article>
</main>

<?php
require("pie.php");



?>