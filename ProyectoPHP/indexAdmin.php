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
} else {
    header("Location:index.php");
}

include "footer.php";
?>