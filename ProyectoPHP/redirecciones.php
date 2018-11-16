<?php
session_start();
require_once "conexion.php";
$conex = new PDO('mysql:host=' . $servidor . '; dbname=' . $bd, $usuario, $contrasenia);
$conex->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$habitacion = $_POST['habitacion'];
$consultaMax = "SELECT MAX(idreserva) FROM reservas";
$resul = $conex->prepare($consultaMax);
$resul->execute();

while ($fila = $resul->fetch(PDO::FETCH_ASSOC)) {
    $idReserva = $fila["MAX(idreserva)"] + 1;
}
$consultar = "INSERT INTO reservas VALUES(" . $idReserva . "," . $_SESSION['idcliente'] . "," . $habitacion . ")";
$resul = $conex->prepare($consultar);
$resul->execute();

$actualizar = "UPDATE habitaciones SET estado='Ocupada' WHERE idhabitaciones=" . $habitacion;
$resul = $conex->prepare($actualizar);
$resul->execute();

if ($_SESSION['usuario'] == "cliente") {
    header("Location:indexCliente.php");
} else if ($_SESSION['usuario'] == "admin") {
    header("Location:reservas.php");
}

?>