<?php

require 'head.php';
require 'conexion.php';

print '<section>
<nav>
    <div class="nav-wrapper deep-purple darken-4 white-text">
      <a href="#" class="brand-logo">Registrese</a>
      <ul id="nav-mobile" class="right hide-on-med-and-down">
        <li><a href="registro.php">Registro</a></li>
        <li><a href="acceso.php">Acceso</a></li>
      </ul>
    </div>
</nav>
</section>';

echo '<div class="row">
<div class="col s4 offset-s4">
    <div class="card deep-purple lighten-2">
        <div class="card-content white-text">
            <span class="card-title">Introduzca sus datos</span>
            <div class="row">
                <form class="col s12" method="post" action="">
                    <div class="row">
                        <div class="input-field col s6">
                            <input id="nombre" type="text" class="validate" name="nombre" required>
                            <label for="nombre">Nombre</label>
                        </div>
                        <div class="input-field col s6">
                            <input id="apellidos" type="text" class="validate" name="apellidos" required>
                            <label for="apellidos">Apellidos</label>
                        </div>
                        <div class="input-field col s12">
                            <input id="dni" type="text" class="validate" name="dni" required>
                            <label for="dni">DNI</label>
                        </div>
                        <div class="input-field col s12">
                            <input id="tarjeta" type="text" class="validate" name="tarjeta" required>
                            <label for="tarjeta">Tarjeta</label>
                        </div>
                        <div class="input-field col s12">
                            <input id="passReg" type="password" class="validate" name="pass" required>
                            <label for="passReg">Contraseña</label>
                        </div>
                        <div class="input-field col s4">
                            <button class="btn waves-effect waves-light deep-purple darken-3" type="submit" name="enviar">Registrarse</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>';

if (isset($_POST['enviar'])) {
    $nombre = htmlspecialchars($_POST['nombre']);
    $apellidos = htmlspecialchars($_POST['apellidos']);
    $pass = md5(htmlspecialchars($_POST['pass']));
    $dni = htmlspecialchars($_POST['dni']);
    $tarjeta = htmlspecialchars($_POST['tarjeta']);

    try {
        $conex = new PDO('mysql:host=' . $servidor . '; dbname=' . $bd, $usuario, $contrasenia);
        $conex->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $selectMax = "SELECT MAX(idclientes) FROM clientes";
        $selectMax2 = "SELECT MAX(idlogin) FROM login";
        $insertarUsuario = "INSERT INTO clientes VALUES (?, ?, ?, ?, ?)";
        $insertarLogin = "INSERT INTO login VALUES(?, ?, ?, 2)";
        $idUsuario = 0;
        $idLogin = 0;

        $resul = $conex->prepare($selectMax);
        $resul->execute();

        while ($fila = $resul->fetch(PDO::FETCH_ASSOC)) {
            $idUsuario = $fila["MAX(idclientes)"] + 1;
        }

        $resul = null;


        $resul = $conex->prepare($selectMax2);
        $resul->execute();

        while ($fila = $resul->fetch(PDO::FETCH_ASSOC)) {
            $idLogin = $fila['MAX(idlogin)'] + 1;
        }

        $resul = $conex->prepare($insertarUsuario);
        $resul->execute(array($idUsuario, $nombre, $apellidos, $dni, $tarjeta));

        $resul = $conex->prepare($insertarLogin);
        $resul->execute(array($idLogin, $dni, $pass));

        header("Location:acceso.php");
    } catch (Exception $e) {
        die("Fallo en el registro, revise los datos o aseguresé de que no se registró previamente");
    }
}
require 'footer.php';
?>