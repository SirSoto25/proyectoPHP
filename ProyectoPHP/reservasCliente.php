<?php
session_start();
include_once "head.php";
require_once "conexion.php";
if ($_SESSION['usuario'] != "") {
    $cliente = $_SESSION['usuario'];
    if ($cliente == "cliente") {
        $conex = new PDO('mysql:host=' . $servidor . '; dbname=' . $bd, $usuario, $contrasenia);
        $conex->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $consultar = "SELECT * FROM clientes WHERE dni = ?";
        $resul = $conex->prepare($consultar);
        $resul->execute(array($_SESSION['dni']));
        $nombre = "";
        $apellidos = "";

        while ($fila = $resul->fetch(PDO::FETCH_ASSOC)) {
            $nombre = $fila['nombre'];
            $apellidos = $fila['apellidos'];

        }
        echo '<nav>
        <div class="nav-wrapper  deep-purple darken-4 white-text">
          <a href="#" class="brand-logo">Bienvenido ' . $nombre . ' ' . $apellidos . '</a>
          <ul id="nav-mobile" class="right hide-on-med-and-down">
            <li><a href="indexCliente.php">Reservar</a></li>
            <li><a href="index.php" class="red darken-2">Desconexión</a></li>
          </ul>
        </div>
      </nav>';

        $consulta = "SELECT * FROM reservas WHERE clientes_idclientes LIKE '%" . $_SESSION['idcliente'] . "%'";
        $resul = $conex->prepare($consulta);
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
                    <td>'.$fila["habitaciones_idhabitaciones"].'</td>
                    <td class="right">
                    <form action="redirecciones2.php" method="post">
                        <input type="password" value="'.$fila["habitaciones_idhabitaciones"].'" name="habitacion" hidden="hidden">
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
                <h1 class="center">No tiene reservas a su nombre</h1>
            </div>';
        }
    }
} else {
    header("Location:index.php");
}
include_once "footer.php";
?>