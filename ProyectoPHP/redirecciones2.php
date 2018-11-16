<?php
session_start();
require_once "conexion.php";
$conex = new PDO('mysql:host=' . $servidor . '; dbname=' . $bd, $usuario, $contrasenia);
$conex->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if (isset($_POST['despedir'])) {
    $empleadoDespedir = $_POST['empleado'];

    $consultaDespedir = "DELETE FROM empleados WHERE idempleados = ?";

    $resul = $conex->prepare($consultaDespedir);
    $resul->execute(array($empleadoDespedir));

    header("Location:empleados.php");

} else {
    $habitacionEliminar = $_POST['habitacion'];

    $consultaEliminar = "DELETE FROM reservas WHERE habitaciones_idhabitaciones = ?";
    $cambiarEstado = "UPDATE habitaciones SET estado = 'Libre' WHERE idhabitaciones = ?";

    $resul = $conex->prepare($consultaEliminar);
    $resul->execute(array($habitacionEliminar));

    $result = $conex->prepare($cambiarEstado);
    $result->execute(array($habitacionEliminar));


    if ($_SESSION['usuario'] == "cliente") {
        header("Location:indexCliente.php");
    } else if ($_SESSION['usuario'] == "admin") {
        header("Location:reservas.php");
    }
}



?>