<?php
session_start();

require 'head.php';
require 'conexion.php';

print '<form method="post" action="">
    Usuario: <input name="user" type="text" width="20"><br>
    Contraseña: <input name="pass" type="password" width="20"><br>
    <input type="submit" name="Enviar" value="Enviar">
</form>';

if (isset($_POST['Enviar'])) {
    $user = htmlspecialchars($_POST['user']);
    $pass = htmlspecialchars($_POST['pass']);
    $_SESSION['pulsado']=true;
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
            if($tipo==1){
                $_SESSION['usuario']="admin";
                header("Location:indexAdmin.php");
            }else{
                $_SESSION['usuario']="cliente";
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

