<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Loteria V2</title>
    <link rel="stylesheet" href="css/estilos.css">
    <?php require 'conex.php'; ?>
  </head>
  <body>
    <h1>Estadistica para Loteriras V2</h1>
    <div class="Menu-General">

    </div>
    <div class="Nueva-Loteria">
      <h2>Agregar una Nueva Loteria</h2>
      <form class="F-Nueva-Loteria" action="agregar_loteria.php" method="post">
        <p>Nombre:</p><input type="text" name="nombre" required>
        <br><input type="submit" name="agregar" value="Agregar">
      </form>
    </div>
  </body>
</html>
