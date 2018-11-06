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
</section><div class="row">
<form method="post" action="" class="col s12">
<div class="row">
<div class="input-field col s6">
<input placeholder="Nombre" name="user" type="text" width="20" class="" id="nombre">
<label for="nombre">Nombre</label>
</div>
<div class="input-field col s6">
<input placeholder="Contraseña" name="pass" type="password" width="20" class="" id="pass">
<label for="pass">Contraseña</label>
</div>
</div>    
</form>
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
            echo 'Datos erroneos';
        }
        $resul = null;
        $conex = null;
    } catch (Exception $e) {
        die('Error: ' . $e->getMessage());
    }
}

require 'footer.php';
?>


Usuario: <input name="user" type="text" width="20"><br>
    Contraseña: <input name="pass" type="password" width="20"><br>
    <input type="submit" name="Enviar" value="Enviar">