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
            echo '<main class="container-fluid bg-verde justify-content-center align-items-center d-flex flex-grow-1 p-0">
            <article class="container text-center mt-5 p-3 bg-light rounded col-10 col-lg-4 pb-0"><p class="mb-4">Usuario guardado con éxito!</p> </article>
            </main>';
        header("refresh:2;url=usuario_listado.php");
        } else {
            echo '<main class="container-fluid bg-verde justify-content-center align-items-center d-flex flex-grow-1 p-0">
            <article class="container text-center mt-5 p-3 bg-light rounded col-10 col-lg-4 pb-0"><p class="mb-4">Hubo un error al guardar el usuario.</p> </article>
            </main>';
            header("refresh:2;url=usuario_listado.php");
        }
        desconectar($conexion);
    }
} else {
    echo '
    <main class="container-fluid bg-verde justify-content-center align-items-center d-flex flex-grow-1 p-0">
    <article class="container text-center mt-5 p-3 bg-light rounded col-10 col-lg-4 pb-0"><p class="mb-4">Faltan completar campos</p> </article>
    </main>';
    header("refresh:2;url=usuario_listado.php");

}

require("pie.php");

?>