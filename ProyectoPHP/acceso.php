<?php
session_start();

require 'head.php';
require 'conexion.php';

print '
<section>
<nav>
    <div class="nav-wrapper deep-purple darken-4 white-text">
      <a href="#" class="brand-logo">Bienvenido a la página de reservas</a>
      <ul id="nav-mobile" class="right hide-on-med-and-down">
        <li><a href="registro.php">Registro</a></li>
        <li><a href="acceso.php">Acceso</a></li>
      </ul>
    </div>
</nav>
</section>
<div class="row">
    <div class="col s4 offset-s4">
        <div class="card deep-purple lighten-2">
            <div class="card-content white-text">
                <span class="card-title">Introduzca sus datos</span>
                <div class="row">
                <div class="row">
        <form class="col s12" action="" method="post">
            <div class="row">
                <div class="input-field col s12">
                    <input id="user" type="text" name="user" class="validate">
                    <label for="user">DNI</label>
                </div>
                <div class="input-field col s12">
                    <input id="pass" type="password" name="pass" class="validate">
                    <label for="pass">Contraseña</label>
                </div>
                <div class="input-field col s4">
                    <button class="btn waves-effect waves-light deep-purple darken-3" type="submit" name="Enviar">Acceder</button>
                </div>
            </div>
        </form>
    </div>
                </div>
            </div>
        </div>
    </div>
</div>';
if (isset($_POST['Enviar'])) {
    $user = htmlspecialchars($_POST['user']);
    $pass = htmlspecialchars($_POST['pass']);
    $_SESSION['pulsado'] = true;
    try {
        $conex = new PDO('mysql:host=' . $servidor . '; dbname=' . $bd, $usuario, $contrasenia);
        $conex->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $consultar = "SELECT * FROM login WHERE usuario = ?";
        $resul = $conex->prepare($consultar);
        $resul->execute(array($user));

        while ($fila = $resul->fetch(PDO::FETCH_ASSOC)) {
            $pass2 = $fila['password'];
            $tipo = $fila['tipo'];
            $_SESSION['dni'] = $fila['usuario'];
        }
        if ($pass2 === md5($pass)) {
            if ($tipo == 1) {
                $_SESSION['usuario'] = "admin";
                header("Location:indexAdmin.php");
            } else {
                $_SESSION['usuario'] = "cliente";
                header("Location:indexCliente.php");
            }
        } else {
            echo '<div class"row">
                <div class="col s12">
                    <h3 class="center red-text">Datos incorrectos</h3>
                </div>
            </div>';
        }
        $resul = null;
        $conex = null;
    } catch (Exception $e) {
        die('Error: ' . $e->getMessage());
    }
}

require 'footer.php';
?>







