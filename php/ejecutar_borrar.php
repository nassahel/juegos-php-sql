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
        echo ' <main class="container-fluid bg-verde justify-content-center align-items-center d-flex flex-grow-1 p-0">
        <article class="container text-center mt-5 p-3 bg-light rounded col-10 col-lg-4 pb-0"><p class="mb-4">Eliminación exitosa!</p> </article>
        </main>';
        header("refresh:2;url=usuario_listado.php");
    }
} else {
    echo '<main class="container-fluid bg-verde justify-content-center align-items-center d-flex flex-grow-1 p-0">
    <article class="container text-center mt-5 p-3 bg-light rounded col-10 col-lg-4 pb-0"><p class="mb-4">No e pudo eliminar</p> </article>
    </main>';
    header("refresh:2;url=usuario_listado.php");
}

desconectar($conexion);
require("pie.php");
