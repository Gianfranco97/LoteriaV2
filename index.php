<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Loteria V2</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/estilos.css">
    <?php require 'conex.php'; ?>
  </head>
  <body>
    <h1>Estadística para Loteríras V2</h1>
    <div class="Menu-General">
      <?php
        $consulta = mysqli_query($enlace, "SELECT * FROM loterias");
        while ($vuelta = mysqli_fetch_assoc($consulta)) {
          echo "<div class='menu'><a href='loteria.php?nombre=".$vuelta['Nombre_loteria']."'<h3>".$vuelta['Nombre_loteria']."</h3></a>";
          echo "<a href='eliminar.php?nombre=".$vuelta['Nombre_loteria']."' class='eliminar'><img src='imagenes/borra.png'/></a></div>";
        }
      ?>
    </div>
    <div class="Nueva-Loteria">
      <h2>Agregar una Nueva Lotería</h2><br>
      <form class="F-Nueva-Loteria" action="agregar_loteria.php" method="post">
        <p>Nombre:</p><input type="text" name="nombre" required>
        <br><input class="boton" type="submit" name="agregar" value="Agregar">
      </form>
    </div>
  </body>
</html>
