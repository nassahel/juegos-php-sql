<?php
session_start();
$ruta = '../';
require("encabezado.php");

if (($_SESSION['tipo'] !== "Administrador")) {
    header("Location: ../index.php");
    exit();
}


if (!empty($_POST['usuario']) && !empty($_POST['pass']) && !empty($_POST['tipo'])) {
    include 'conexion.php';
    $conexion = conectar();

    if ($conexion) {
        $usuario = $_POST['usuario'];
        $pass = sha1($_POST['pass']);
        $tipo = $_POST['tipo'];

        if (!empty($_FILES['foto']['size'])) {
            $foto = $_FILES['foto']['name']; // saefgdadfgdf242.png
            $ext = explode('.', $foto); // [jpepe, png]
            $fotoParaBD = $usuario . '.' . $ext[1]; // nassa.png
            $rutaDestino = "../img/usuarios/" . $fotoParaBD; // '../img/usuarios/nassa.png'
            $envio = move_uploaded_file($_FILES['foto']['tmp_name'], $rutaDestino);
        } else {
            $fotoParaBD = "";
        }
        $consulta = 'INSERT INTO usuario(usuario, pass, tipo, foto)
                     VALUES(?,?,?,?)';

        $sentencia = mysqli_prepare($conexion, $consulta);
        mysqli_stmt_bind_param($sentencia, 'ssss', $usuario, $pass, $tipo, $fotoParaBD);
        $q = mysqli_stmt_execute($sentencia); //true o false

        if ($q) {
            echo '<article class="container text-center mt-5 p-3"><p class="mb-4">Usuario guardado!!</p> </article>';
        header("refresh:2;url=usuario_listado.php");
        } else {
            echo '<p>Error Al guardar</p>';
            header("refresh:2;url=usuario_listado.php");
        }
        desconectar($conexion);
    }
} else {
    echo '<p>Faltan completar campos</p>';
}

require("pie.php");

?>