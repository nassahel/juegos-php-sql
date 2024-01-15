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

if ($conexion && isset($_POST['id'])) {
    $id = $_POST['id'];
    $usuario = $_POST['usuario'];
    $tipo = $_POST['tipo'];
    $pass = sha1($_POST['pass']);
    $fotoEliminar = '../img/usuarios/' . $_POST['fotoActual'];

    if (!empty($_FILES['foto']['size'])) {

        if (file_exists($fotoEliminar) && ($fotoEliminar != '../img/usuarios/usuario_default.png')) {
            unlink($fotoEliminar);
        }
        $fotoEnv = $_FILES['foto']['name'];
        $ext = explode('.', $fotoEnv);
        $fotoParaBD = $usuario . '.' . $ext[1];
        $rutaDestino = "../img/usuarios/" . $usuario . '.' . $ext[1];
        $envio = move_uploaded_file($_FILES['foto']['tmp_name'], $rutaDestino);
    } else {
        $fotoParaBD = '';
    }

    $consulta = 'UPDATE usuario SET usuario = ?, tipo = ?, pass = ?, foto = ? WHERE id_usuario = ?';
    $sentencia = mysqli_prepare($conexion, $consulta);
    mysqli_stmt_bind_param($sentencia, 'ssssi', $usuario, $tipo, $pass, $fotoParaBD, $id);
    $estado = mysqli_stmt_execute($sentencia);

    if ($estado) {
        echo '<article class="container text-center mt-5 p-3"><p class="mb-4">Usuario editado con éxito</p> </article>';
        header("refresh:2;url=usuario_listado.php");
    }
} else {
    echo '<article class="container text-center mt-5 p-3"><p class="mb-4">No se pudo editar usuario</p> </article>';
    header("refresh:2;url=usuario_listado.php");
}

desconectar($conexion);

require("pie.php");
