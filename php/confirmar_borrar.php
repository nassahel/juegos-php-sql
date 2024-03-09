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
    $consulta = 'SELECT usuario FROM usuario WHERE id_usuario = ?';
    $sentencia = mysqli_prepare($conexion, $consulta);
    mysqli_stmt_bind_param($sentencia, 'i', $id);
    mysqli_stmt_execute($sentencia);
    mysqli_stmt_bind_result($sentencia, $usuario);
    mysqli_stmt_store_result($sentencia);
    $cantFilas = mysqli_stmt_num_rows($sentencia);

    if ($cantFilas > 0) {
        echo '<main class="container-fluid bg-verde justify-content-center align-items-center d-flex flex-grow-1 p-0">';
        echo '<article class="container text-center mt-5 p-3 bg-light rounded col-11 col-lg-4"><h2 class="mb-4">Eliminar Usuario</h2>';

        while (mysqli_stmt_fetch($sentencia)) {
           
            echo '<p class="mb-4">Esta seguro de eliminar al usuario <strong>' . $usuario . '</strong>?</p>';
            echo '<section class="mb-4"><a class="btn btn-success me-2" href="ejecutar_borrar.php?id=' . $id . '">Aceptar</a>';
            echo '<a class="btn btn-danger " href="usuario_listado.php">Cancelar</a></section></article>';
            echo '</main>';
        }
    }
    desconectar($conexion);
}

require("pie.php");
