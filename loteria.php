<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Estadísticas</title>
    <link rel="stylesheet" href="css/estilos.css">
    <?php require 'conex.php'; ?>
  </head>
  <body>
    <?php
      echo "<h1>Bienvenido a las estadísticas de ". $_GET['nombre'] ."</h1>";
    ?>
    <form class="formulario" action="loteria.php" method="post">
      <h2>Agregar datos nuevos</h2>
      <p><strong>Tipo de dato:</strong></p><br>
      Dos digitos<input type="radio" name="tipo_dato" value="2" required>
      Tres digitos<input type="radio" name="tipo_dato" value="3" required>
      <p><strong>Valor:</strong></p>
      <input type="number" name="valor">
      <input type="submit" name="boton" value="enviar">
    </form>
      
    </div>
  </body>
</html>
