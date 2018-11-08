<?php

require 'head.php';
require 'conexion.php';

/*echo '<form method="POST" action="">
    Nombre: <input type="text" name="nombre"> Apellidos: <input type="text" name="apellidos"><br>
    Contraseña: <input type="password" name="pass"><br>
    DNI: <input type="text" name="dni"> Tarjeta: <input type="text" name="tarjeta"><br>
    <input type="submit" value="Enviar" name="enviar">
</form>';*/

echo '<div class="row">
<div class="col s4 offset-s4">
    <div class="card deep-purple lighten-2">
        <div class="card-content white-text">
            <span class="card-title">Introduzca sus datos</span>
            <div class="row">
                <form class="col s12" method="post" action="">
                    <div class="row">
                        <div class="input-field col s6">
                            <input id="nombre" type="text" class="validate" name="nombre">
                            <label for="nombre">Nombre</label>
                        </div>
                        <div class="input-field col s6">
                            <input id="apellidos" type="text" class="validate" name="apellidos">
                            <label for="apellidos">Apellidos</label>
                        </div>
                        <div class="input-field col s12">
                            <input id="dni" type="text" class="validate" name="dni">
                            <label for="dni">DNI</label>
                        </div>
                        <div class="input-field col s12">
                            <input id="tarjeta" type="text" class="validate" name="tarjeta">
                            <label for="tarjeta">Tarjeta</label>
                        </div>
                        <div class="input-field col s12">
                            <input id="passReg" type="password" class="validate" name="pass">
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
        die('Error: ' . $e->getMessage());
    }
}
require 'footer.php';
?>