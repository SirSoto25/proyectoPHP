<?php
session_start();
$usuario=$_SESSION['usuario'];
include "head.php";
echo '<h1>Bienvenido '.$usuario.'</h1>';
include "footer.php";
?>