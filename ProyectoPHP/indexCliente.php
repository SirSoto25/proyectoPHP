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
        }
        echo '<nav>
        <div class="nav-wrapper  deep-purple darken-4 white-text">
          <a href="#" class="brand-logo">Bienvenido ' . $nombre . ' ' . $apellidos . '</a>
          <ul id="nav-mobile" class="right hide-on-med-and-down">
            <li><a href="reservar.php">Reservar</a></li>
            <li><a href="misReservas.php">Mis reservas</a></li>
            <li><a href="index.php" class="red darken-2">Desconexión</a></li>
          </ul>
        </div>
      </nav>';
    } else {
        header("Location:index.php");
    }
} else {
    header("Location:index.php");
}
include "footer.php";
?>