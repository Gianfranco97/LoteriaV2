<?php
  require("conex.php");
  $Nombre_loteria = $_POST['nombre'];
  mysqli_query($enlace, "INSERT INTO loterias ('Nombre_loteria') VALUES ($Nombre_loteria)");
  mysqli_query($enlace, "INSERT INTO datos_2dig ('N_loteria') VALUES ($Nombre_loteria)");
  mysqli_query($enlace, "INSERT INTO datos_2dig ('ultimo_ingreso_2dig') VALUES (0)");
  for ($i=1; $i <= 100; $i++) {
    $sql = "INSERT INTO datos_2dig ('dig". $i ."') VALUES (0)";
    mysqli_query($enlace, $sql);
  }
  mysqli_query($enlace, "INSERT INTO datos_3dig ('N_loteria') VALUES ($Nombre_loteria)");
  mysqli_query($enlace, "INSERT INTO datos_3dig ('ultimo_ingreso_2dig') VALUES (0)");
  for ($i=1; $i <= 1000; $i++) {
    $sql = "INSERT INTO datos_2dig ('dig". $i ."') VALUES (0)";
    mysqli_query($enlace, $sql);
  }
  header("Location: index.php");
?>
