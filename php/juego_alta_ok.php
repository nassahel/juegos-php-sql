<?php
session_start();
$ruta = '../';
require("encabezado.php");

if (($_SESSION['tipo'] !== "Administrador")) {
    header("Location: ../index.php");
    exit();
}

if (!empty($_POST['titulo']) && !empty($_POST['jugadores']) && !empty($_POST['lanzamiento']) && !empty($_POST['genero'])) {
    include 'conexion.php';
    $conexion = conectar();

    if ($conexion) {
        $titulo = $_POST['titulo'];
        $jugadores = $_POST['jugadores'];
        $lanzamiento = $_POST['lanzamiento'];
        $genero = $_POST['genero'];

        if (!empty($_FILES['portada']['size'])) {
            $portada = $_FILES['portada']['name']; //nombre.jpg
            $ext = explode('.', $portada); 
            $portadaParaBD = str_replace(' ', '_', $titulo) . '.' . $ext[1];
            $rutaDestino = "../img/portadas/" . $portadaParaBD;
            $envio = move_uploaded_file($_FILES['portada']['tmp_name'], $rutaDestino);
        } else {
            $portadaParaBD = "";
        }
        $consulta = 'INSERT INTO juego(titulo, jugadores, lanzamiento, genero, portada)
                     VALUES(?,?,?,?,?)';
        

        $sentencia = mysqli_prepare($conexion, $consulta);
        mysqli_stmt_bind_param($sentencia, 'sssss', $titulo, $jugadores, $lanzamiento, $genero, $portadaParaBD);
        $q = mysqli_stmt_execute($sentencia); //true o false

        if ($q) {
            echo '<article class="container text-center mt-5 p-3"><p class="mb-4">Juego guardado!!</p> </article>';
            header("refresh:2;url=juego_listado.php");
        } else {
            echo '<p>Error Al guardar</p>';
            header("refresh:2;url=juego_listado.php");
        }
        desconectar($conexion);
    }
} else {
    echo '<p>Faltan completar campos</p>';
}

require("pie.php");
