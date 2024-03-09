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
$consulta = 'SELECT id_usuario, usuario, tipo, foto FROM usuario WHERE activado = "S"';
$sentencia = mysqli_prepare($conexion, $consulta);
mysqli_stmt_execute($sentencia);
mysqli_stmt_bind_result($sentencia, $id, $usuarioBD, $tipoBD, $fotoBD);
?>

<main class="container-fluid bg-verde d-flex flex-grow-1 p-0">
    <article class="container-fluid p-0">
        <section class="text-light text-center fw-bold mb-5">
            <p class="bg-success py-2 ">Opción: Usuarios > Listado</p>
        </section>
    
        <article class="">
            <section class="menu_tmp">
                <a class="btn btn-dark" href="juego_listado.php"> < Volver</a>
                <a class="btn btn-dark" href="usuario_alta.php">+ Alta usuario</a>
            </section>
            <table class="table table-bordered table-hover table-striped rounded overflow-hidden shadow w-75">
                <caption class="caption-top text-center bg-dark">Listado de usuarios</caption>
                <tr>
                    <th class="bg-secondary text-white">Foto</th>
                    <th class="bg-secondary text-white">Usuario</th>
                    <th class="bg-secondary text-white">Tipo</th>
                    <th class="bg-secondary text-white">Modificar</th>
                    <th class="bg-secondary text-white">Eliminar</th>
                    <th class="bg-secondary text-white">Desactivar</th>
                </tr>

                <?php
                while (mysqli_stmt_fetch($sentencia)) {
                    echo '<tr class="align-middle">';
                    echo '<td> <img class="img-fluid rounded " width="120" src="../img/usuarios/' . ($fotoBD == "" ? "usuario_default.png" : $fotoBD) . '" alt=""> </td>';
                    echo  '<td>' . $usuarioBD . '</td>';
                    echo  '<td>' . $tipoBD . '</td>';
                    echo  '<td><a href="confirmar_modificar.php?id=' . $id . '"><img src="../img/modificar.png"></a></td>';
                    echo  '<td><a href="confirmar_borrar.php?id=' . $id . '"><img src="../img/eliminar.png"></a></td>';
                    echo  '<td><a href="confirmar_desactivar.php?id=' . $id . '"><img src="../img/desactivar.png"></a></td>';
                    echo '</tr>';
                }
                desconectar($conexion);
                ?>
            </table>
        </article>
    
</main>

<?php
require("pie.php");
?>