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
    $titulo = $_POST['titulo']; //crash bandicot
    $jugadores = $_POST['jugadores'];
    $lanzamiento = $_POST['lanzamiento'];
    $genero = $_POST['genero'];
    $fotoEliminar = '../img/portadas/' . $_POST['portadaActual'];
    $tituloGuion = implode("_", explode(" ", $titulo));

    if (!empty($_FILES['portada']['size'])) {

        if (file_exists($fotoEliminar) && ($fotoEliminar != '../img/portadas/portada_default.png')) {
            unlink($fotoEliminar);
        }


        $fotoEnv = $_FILES['portada']['name'];
        $ext = explode('.', $fotoEnv);
        $fotoParaBD = $tituloGuion . '.' . $ext[1]; // crash_bandicot.jpg
        $rutaDestino = "../img/portadas/" . str_replace(' ', '_', $titulo) . '.' . $ext[1];
        $envio = move_uploaded_file($_FILES['portada']['tmp_name'], $rutaDestino);
    } else {
        $fotoParaBD = '';
    }

    $consulta = 'UPDATE juego SET titulo = ?, jugadores = ?, lanzamiento = ?, genero = ?, portada = ? WHERE id_juego = ?';
    $sentencia = mysqli_prepare($conexion, $consulta);
    mysqli_stmt_bind_param($sentencia, 'sssssi', $titulo, $jugadores, $lanzamiento, $genero, $fotoParaBD, $id);
    $estado = mysqli_stmt_execute($sentencia);

    if ($estado) {
        echo '<article class="container text-center mt-5 p-3"><p class="mb-4">Juego editado con éxito</p> </article>';
        header("refresh:2;url=juego_listado.php");
    }
} else {
    echo '<article class="container text-center mt-5 p-3"><p class="mb-4">No se pudo editar Juego</p> </article>';
    header("refresh:2;url=juego_listado.php");
}

desconectar($conexion);

require("pie.php");
