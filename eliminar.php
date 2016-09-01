<?php
require('conex.php');
$nombre = $_GET['nombre'];
mysqli_query($enlace, "DELETE FROM loterias WHERE Nombre_loteria = '$nombre'");
mysqli_query($enlace, "DELETE FROM datos_2dig WHERE N_loteria = '$nombre'");
mysqli_query($enlace, "DELETE FROM datos_3dig WHERE N_loteria = '$nombre'");
header("Location: index.php")
?>
