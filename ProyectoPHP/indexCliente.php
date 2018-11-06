<?php
session_start();
include "head.php";
require_once "conexion.php";
if(isset($_SESSION['pulsado'])){
    $cliente = $_SESSION['usuario'];
    if($cliente == "cliente"){
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
        echo '<h1>Bienvenido '.$nombre.' '.$apellidos.'</h1>';
    }else{
        header("Location:index.php");
    }
}else{
    header("Location:index.php");
}
include "footer.php";
?>