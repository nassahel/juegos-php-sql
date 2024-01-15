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

if ($conexion && !empty($_GET['id'])) {
    $id = $_GET['id'];
    // $desactivar = 'N';

    $consulta = 'UPDATE usuario SET activado = "N" WHERE id_usuario = ?';
    $sentencia = mysqli_prepare($conexion, $consulta);
    mysqli_stmt_bind_param($sentencia, 'i', $id);
    $estado = mysqli_stmt_execute($sentencia);

    if ($estado) {
        echo '<article class="container text-center mt-5 p-3"><p class="mb-4">Usuario desactivado con éxito</p> </article>';
        header("refresh:2;url=usuario_listado.php");
    }
} else {
    echo '<article class="container text-center mt-5 p-3"><p class="mb-4">No se pudo desactivar usuario</p> </article>';
    header("refresh:2;url=usuario_listado.php");
}

desconectar($conexion);

require("pie.php");
