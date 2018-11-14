<?php
session_start();
include "head.php";
require_once "conexion.php";
if (($_SESSION['usuario']) != "") {
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
    $consultar = "SELECT * FROM reservas";
    $resul = $conex->prepare($consultar);
    $resul->execute();

    if ($resul->rowCount() > 0) {
        echo '
      <div class="row">
        <div class="col s6 offset-s3">
        <table class="highlight">
            <thead>
                <tr>
                    <td>Habitación</td>
                </tr>
            </thead>
            <tbody>';
        while ($fila = $resul->fetch(PDO::FETCH_ASSOC)) {
            echo '
            <tr>
                <td>' . $fila["habitaciones_idhabitaciones"] . '</td>
                <td class="right">
                <form action="redirecciones2.php" method="post">
                    <input type="password" value="' . $fila["habitaciones_idhabitaciones"] . '" name="habitacion" hidden="hidden">
                    <button class="btn waves-effect waves-light deep-purple darken-3" type="submit" name="eliminar">Eliminar</button>
                </form>
                </td>
            </tr>';
        }
        echo '
      </tbody>
  </table>
  </div>
  </div>';
    } else {
        echo '
        <div class="col s12">
            <h1 class="center">En estos momentos no hay ninguna reserva en ningún Hotel</h1>
        </div>';
    }

} else {
    header("Location:index.php");
}

include "footer.php";
?>