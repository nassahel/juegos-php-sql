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

if ($conexion && isset($_GET['id'])) {
    $id = $_GET['id'];
    $consulta = 'SELECT usuario, tipo, foto FROM usuario WHERE id_usuario = ?';
    $sentencia = mysqli_prepare($conexion, $consulta);
    mysqli_stmt_bind_param($sentencia, 'i', $id);
    mysqli_stmt_execute($sentencia);
    mysqli_stmt_bind_result($sentencia, $usuario, $tipo, $foto);
    mysqli_stmt_store_result($sentencia);
    $cantFilas = mysqli_stmt_num_rows($sentencia);
    mysqli_stmt_fetch($sentencia);
    $foto == '' ? $foto = 'usuario_default.png' : $foto;
    desconectar($conexion);
}
?>

<main class="container">
    <section>
        <article>
            <section class="menu_tmp">
                <p>Opción: Usuarios > Editar</p>
            </section>
            <form action="ejecutar_modificar.php" method="post" class="bg-success border-info text-white" enctype="multipart/form-data">
                <legend class="bg-dark border-info text-center">Modificar usuario</legend>
                <section>
                    <label for="usuario" class="form-label">Usuario</label>
                    <input type="text" name="usuario" id="usuario" value="<?php echo $usuario ?>" required maxlength="45" class="form-control border-warning">
                    <label for="pass" class="form-label">Contraseña</label>
                    <input type="password" name="pass" id="pass" placeholder="Contraseña" required maxlength="45" class="form-control border-warning">
                    <label for="tipo" class="form-label">Tipo actual </label>
                    <input type="text" class="bg-warning p-2 rounded text-center" readonly name="tipoActual" id="tipoActual" value="<?php echo $tipo ?>" required maxlength="45" class="form-control border-warning">
                    <label for="tipo" class="form-label">Cambiar tipo</label>
                    <select name="tipo" id="tipo" class="form-select border-warning">
                        <option value="Administrador">Administrador</option>
                        <option value="Común">Común</option>
                    </select>
                    <label for="foto" class="form-label">Nueva Foto</label>
                    <input type="file" name="foto" id="foto" class="form-control border-warning">
                    <section class="text-center">
                        <input type="hidden" name="fotoActual" id="fotoActual" value="<?php echo $foto ?>">
                        <!-- Id oculto ---------------------------- -->
                        <input type="hidden" name="id" id="id" value="<?php echo $id ?>">
                        <input type="submit" name="enviar" value="Actualizar" class="btn btn-dark mt-3 mb-3">

                        <a class="btn btn-danger" href="usuario_listado.php">Volver</a>
                    </section>
                </section>
            </form>
        </article>
    </section>
</main>

<?php
require("pie.php");
?>