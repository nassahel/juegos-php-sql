<?php
session_start();
$ruta = '../';
require("encabezado.php");


if (!empty($_POST['usuario']) && !empty($_POST['pass'])) {
    include 'conexion.php';
    $conexion = conectar();
    if ($conexion) {
        $usuario = $_POST['usuario'];
        $contrasenia = sha1($_POST['pass']);
        $consulta = 'SELECT usuario, foto, tipo FROM usuario WHERE usuario = ? AND pass = ?';
        $sentencia = mysqli_prepare($conexion, $consulta);
        mysqli_stmt_bind_param($sentencia, 'ss', $usuario, $contrasenia);
        mysqli_stmt_execute($sentencia);
        mysqli_stmt_bind_result($sentencia, $usuarioBD, $fotoBD, $tipoBD);
        mysqli_stmt_store_result($sentencia);
        $cantFilas = mysqli_stmt_num_rows($sentencia);
        if ($cantFilas == 1) {
            mysqli_stmt_fetch($sentencia);
            header('refresh:0; juego_listado.php');
            $_SESSION['usuario'] = $usuarioBD;
            $_SESSION['foto'] = $fotoBD;
            $_SESSION['tipo'] = $tipoBD;
        } else {
                       
            echo '<article class="container text-center mt-5 p-3"><p class="mb-4">Datos incorrectos</p> </article>';
            header("Location: ../index.php");
           
        }
        desconectar($conexion);
    }
}


require("pie.php");
