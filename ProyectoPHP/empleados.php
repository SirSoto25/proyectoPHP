<?php
session_start();
include "head.php";
require_once "conexion.php";
if (($_SESSION['usuario']) == "admin") {
    echo '<nav>
    <div class="nav-wrapper  deep-purple darken-4 white-text">
      <a href="#" class="brand-logo">Bienvenido Administrador</a>
      <ul id="nav-mobile" class="right hide-on-med-and-down">
        <li><a href="reservas.php">Reservas</a></li>
        <li><a href="empleados.php">Empleados</a></li>
        <li><a href="index.php" class="red darken-2">Desconexión</a></li>
      </ul>
    </div>
  </nav>';
    $conex = new PDO('mysql:host=' . $servidor . '; dbname=' . $bd, $usuario, $contrasenia);
    $conex->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $consultar = "SELECT * FROM empleados";
    $resul = $conex->prepare($consultar);
    $resul->execute();

    if ($resul->rowCount() > 0) {
        echo '
      <div class="row">
        <div class="col s6 offset-s3">
        <table class="highlight">
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Nombre</td>
                    <td>Apellidos</td>
                    <td>Puesto</td>
                    <td>Hotel</td>
                </tr>
            </thead>
            <tbody>';
        while ($fila = $resul->fetch(PDO::FETCH_ASSOC)) {
            echo '
            <form action="redirecciones2.php" method="post">
            <tr>
                <td>' . $fila["idempleados"] . '</td>
                <td>' . $fila["nombre"] . '</td>
                <td>' . $fila["apellidos"] . '</td>
                <td><input type="text" name="puesto" value="' . $fila["tipo"] . '"></td>
                <td>' . $fila["hoteles_nombre"] . '</td>
                <td class="right">
                    <input type="password" value="' . $fila["idempleados"] . '" name="empleado" hidden="hidden">
                    <button class="btn waves-effect waves-light deep-purple darken-3" type="submit" name="despedir">Despedir</button>
                    <button class="btn waves-effect waves-light deep-purple darken-3" type="submit" name="editar">Editar</button>
                </td>
            </tr>
            </form>';
        }
        echo '
      </tbody>
  </table>
  </div>
  </div>';
    }else{
        echo '
        <div class="col s12">
            <h1 class="center">No quedan empleados a los que despedir</h1>
        </div>';
    }
} else {
    header("Location:index.php");
}

include "footer.php";
?>
