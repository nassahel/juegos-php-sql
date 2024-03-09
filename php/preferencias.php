<?php
session_start();
$ruta = '../';
require("encabezado.php");
if (!isset($_SESSION['usuario'])) {
    header("Location: ../index.php");
    exit();
}
?>

<main class="d-flex flex-grow-1 bg-verde">
    <section class="row col-12 px-0">
        <section class="col-12 col-md-4 col-xl-2 menu pt-4">
            <?php require("menu.php"); ?>
        </section>
        <article class="col-8 mx-auto pt-2">
            <article class="col-10 col-md-6 col-lg-4 mx-auto listado pt-2">
                <h2 class="col-12 text-center mt-4">Preferencias</h2>
                <form class="col-12 mt-2 mb-2 p-2 bg-light border" method="post" action="guardar_preferencias.php">
                    <legend class="text-center bg-secondary p-2">Género favorito</legend>
                    <label class="form-label mt-3">Elija el género:</label>
                    <select class="form-select" name="genero" id="genero">
                        <option value="Rol">Rol</option>
                        <option value="Survival">Survival</option>
                        <option value="Estrategia">Estrategia</option>
                    </select>
                    <section class="text-center">
                        <input type="submit" value="Guardar" class="btn btn-success mt-3 mb-3">
                    </section>
                </form>
                <form class="col-12" action="borrar_preferencias.php" method="post">
                    <section class="mx-auto col-md-6">
                        <input type="submit" value="Borrar Preferencias" class="btn btn-danger mt-3 mb-3">
                    </section>
                </form>
            </article>
    </section>
</main>

<?php
require("pie.php");
?>