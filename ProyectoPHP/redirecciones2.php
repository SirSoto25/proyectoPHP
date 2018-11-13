<?php
session_start();
require_once "conexion.php";
$conex = new PDO('mysql:host=' . $servidor . '; dbname=' . $bd, $usuario, $contrasenia);
$conex->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$habitacionEliminar = $_POST['habitacion'];

$consultaEliminar = "DELETE FROM reservas WHERE habitaciones_idhabitaciones = ?";
$cambiarEstado = "UPDATE habitaciones SET estado = 'Libre' WHERE idhabitaciones = ?";

$resul = $conex->prepare($consultaEliminar);
$resul->execute(array($habitacionEliminar));

$result = $conex->prepare($cambiarEstado);
$result->execute(array($habitacionEliminar));

header("Location:reservasCliente.php");
?>