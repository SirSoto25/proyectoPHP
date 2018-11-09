<?php
session_start();
include "head.php";
require_once "conexion.php";
if (isset($_SESSION['pulsado'])) {
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
            $idcliente = $fila['idclientes'];
        }
        echo '<nav>
        <div class="nav-wrapper  deep-purple darken-4 white-text">
          <a href="#" class="brand-logo">Bienvenido ' . $nombre . ' ' . $apellidos . '</a>
          <ul id="nav-mobile" class="right hide-on-med-and-down">
            <li><a href="indexCliente.php">Reservar</a></li>
            <li><a href="reservasCliente.php">Mis reservas</a></li>
            <li><a href="index.php" class="red darken-2">Desconexión</a></li>
          </ul>
        </div>
      </nav>';

        $consultar = "SELECT * FROM habitaciones WHERE estado LIKE '%Libre%'";
        $resul = $conex->prepare($consultar);
        $resul->execute();

        if ($resul->rowCount() > 0) {
            echo '
            <div class="row">
            <div class="col s10 offset-s1">
            <table class="highlight">
                <thead>
                    <tr>
                        <td>Número de Habitación</td>
                        <td>Hotel</td>
                        <td>Reservar</td>
                    </tr>
                </thead>
                <tbody>';                
            while ($fila = $resul->fetch(PDO::FETCH_ASSOC)) {
                echo '
                    <tr>
                        <td>'.$fila["idhabitaciones"].'</td>
                        <td>'.$fila["hoteles_nombre"].'</td>
                        <td>
                        <form action="" method="post">
                            <input type="password" value="'.$fila["idhabitaciones"].'" name="habitacion" hidden="hidden">
                            <button class="btn waves-effect waves-light deep-purple darken-3" type="submit" name="reservar">Reservar</button>
                        </form>
                        </td>
                    </tr>';
            }
            echo '
                </tbody>
            </table>
            </div>
            </div>';

            if(isset($_POST['reservar'])){
                $habitacion = $_POST['habitacion'];
                $consultaMax = "SELECT MAX(idreserva) FROM reservas";
                $resul = $conex->prepare($consultaMax);
                $resul->execute();

                while($fila = $resul->fetch(PDO::FETCH_ASSOC)){
                    $idReserva = $fila["MAX(idreserva)"] + 1;
                }
                $consultar = "INSERT INTO reservas VALUES(".$idReserva.",".$idcliente.",".$habitacion.")";
                $resul = $conex->prepare($consultar);
                $resul->execute();

                $actualizar = "UPDATE habitaciones SET estado='Ocupada' WHERE idhabitaciones=".$habitacion;
                $resul = $conex->prepare($actualizar);
                $resul->execute();

                header("Location:indexCliente.php");
            }
        }else{
            echo '
            <div class="row">
                <div class="col s12 purple-text">
                    <h1>Todos nuestros hoteles están llenos. Lo sentimos</h1>
                </div>
            </div>';
        }
    } else {
        header("Location:index.php");
    }
} else {
    header("Location:index.php");
}
include "footer.php";
?>