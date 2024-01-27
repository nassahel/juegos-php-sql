<?php
session_start();
$ruta = '../';
require("encabezado.php");
if (!isset($_SESSION['usuario'])) {
    header("Location: ../index.php");
    exit();
}

include 'conexion.php';
$conexion = conectar();
$id = $_GET['id'];

if ($conexion && !empty($_GET['id'])) {
    $consulta = 'SELECT titulo FROM juego WHERE id_juego = ?';
    $sentencia = mysqli_prepare($conexion, $consulta);
    mysqli_stmt_bind_param($sentencia, 'i', $id);
    mysqli_stmt_execute($sentencia);
    mysqli_stmt_bind_result($sentencia, $titulo);
    mysqli_stmt_store_result($sentencia);
    $cantFilas = mysqli_stmt_num_rows($sentencia);

    if ($cantFilas > 0) {
        echo '<article class="col-8 col-lg-4 m-auto text-center mt-5 p-3"><h2 class="mb-4">Eliminar Juego</h2>';

        while (mysqli_stmt_fetch($sentencia)) {
            echo '<p class="mb-4">Esta seguro de eliminar al juego <strong>' . $titulo . '</strong>?</p>';
            echo '<section class="mb-4"><a class="btn btn-success me-2" href="juego_borrar_ok.php?id=' . $id . '">Aceptar</a>';
            echo '<a class="btn btn-danger " href="juego_listado.php">Cancelar</a></section></article>
            ';
        }
    }
    desconectar($conexion);
}

require("pie.php");
