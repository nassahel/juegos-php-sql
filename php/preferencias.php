<?php
session_start();
    $ruta = '../';
    require("encabezado.php");
    if (!isset($_SESSION['usuario'])) {
        header("Location: ../index.php");
        exit();
    }
?>

<main class="container">
    <section class="row">
        <section class="col-3 menu pt-4">
            <?php require("menu.php"); ?>
        </section>
        <article class="col-9 listado pt-2">
            <h2 class="col-12 text-center mt-4">Preferencias</h2>
            <!-- Obtener los géneros mediante una consulta SQL (si así lo prefiere) -->
                            <form class="col-5 mt-2 mb-2 p-2 bg-light border" method="post" action="guardar_preferencias.php">
                                <legend class="text-center bg-secondary p-2">Género favorito</legend>
                                <label class="form-label mt-3">Elija el género:</label>
                                <select class="form-select" name="genero" id="genero">
                                    <option value="Rol">Rol</option>
                                    <option value="Survival">Survival</option>
                                    <option value="Estrategia">Estrategia</option>
                                    <!-- etiquetas option a mano o bucle recorriendo los resultados de la consulta -->
                                </select>
                                <section class="text-center">
                                    <input type="submit" value="Guardar" class="btn btn-success mt-3 mb-3">
                                </section>
                            </form>
                            <form class="col-12" action="borrar_preferencias.php" method="post">
                            <section class="mx-auto col-3">
                                    <input type="submit" value="Borrar Preferencias" class="btn btn-danger mt-3 mb-3">
                                </section>
                            </form>
        </article>
    </section>
</main>

<?php
    require("pie.php");
?>