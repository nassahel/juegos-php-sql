<?php
$ruta = '';
require("php/encabezado.php");
?>
<main class="d-flex bg-verde flex-column align-items-center p-0 flex-grow-1">
    <header class="">
        <section class="d-flex align-items-center justify-content-around">
            <img src="img/kirby.gif" width="55" alt="">
            <img src="img/mario.gif" width="55" alt="">
            <h1 class="p-0 text-center display-5 fw-bold">JUEGAZOS</h1>
            <img src="img/yoshi.gif" width="55" alt="">
            <img src="img/pacman.gif" width="55" alt="">

        </section>
        <img src="img\banner.webp" alt="" class="img-fluid">
    </header>
    <section class="container-fluid d-flex flex-grow-1 justify-content-center align-items-center">
        <form action="php/logueo.php" method="post" class="col-12 col-md-8 col-lg-5 col-xl-3">
            <fieldset class="card bg-dark col-11 md-col-6 mx-auto text-white" style="border-radius: 1rem;">
                <section class="card-body p-5 text-center">
                    <h2 class="fw-bold mb-2">INICIAR SESIÓN</h2>
                    <p class="text-white-50 mb-5">Ingrese su mail y contraseña</p>

                    <section class="form-outline form-white mb-4">
                        <input type="text" id="user" name="usuario" required class="form-control form-control-lg" />
                        <label class="form-label" for="user">Usuario</label>
                    </section>

                    <section class="form-outline form-white mb-4">
                        <input type="password" id="pass" name="pass" required class="form-control form-control-lg" />
                        <label class="form-label" for="pass">Contraseña</label>
                    </section>

                    <button class="btn btn-outline-light btn-lg px-5" type="submit">Login</button>
                </section>
            </fieldset>
        </form>

    </section>

</main>
<?php
require("php/pie.php");
?>