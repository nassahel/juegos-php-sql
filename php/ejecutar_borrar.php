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
    $consulta = 'DELETE FROM usuario WHERE id_usuario = ?';
    $sentencia = mysqli_prepare($conexion, $consulta);
    mysqli_stmt_bind_param($sentencia, 'i', $id);
    $resultado = mysqli_stmt_execute($sentencia);

    if ($resultado) {
        echo '<article class="container text-center mt-5 p-3"><p class="mb-4">Eliminación exitosa</p> </article>';
        header("refresh:2;url=usuario_listado.php");
    }
} else {
    echo '<article class="container text-center mt-5 p-3"><p class="mb-4">No se pudo eliminar</p> </article>';
    header("refresh:2;url=usuario_listado.php");
}

desconectar($conexion);
require("pie.php");
