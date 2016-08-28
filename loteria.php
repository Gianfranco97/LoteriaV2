<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Estadísticas</title>
    <link rel="stylesheet" href="css/estilos.css">
    <?php
      require 'conex.php';
      $nombre_loteria = $_GET['nombre'];
    ?>
  </head>
  <body>
    <?php
      echo "<h1>Bienvenido a las estadísticas de ". $nombre_loteria ."</h1>";
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
      <div class="Datos">
        <?php
          $sqlDos = mysqli_query($enlace, "SELECT * form datos_2dig WHERE N_loteria =". $nombre_loteria);
          $dosDigitos = mysqli_fetch_assoc($sqlDos);
          $sqlTres = mysqli_query($enlace, "SELECT * form datos_3dig WHERE N_loteria =". $nombre_loteria);
          $tresDigitos = mysqli_fetch_assoc($sqlTres);
          if (isset($_POST['boton'])) {
            if ($_POST['tipo_dato'] == 2) {
              $ultimo_dato = mysqli_query($enlace, "SELECT ultimo_ingreso_2dig form datos_2dig WHERE N_loteria =". $nombre_loteria);
              //Dos Digitos
              if ($ultimo_dato < 100) {
                $nuevo_dato = $ultimo_dato + 1;
              }
              else {
                $nuevo_dato = 1;
              }
              mysqli_query($enlace, "UPDATE datos_2dig SET dig".$nuevo_dato."=".$_POST['valor']."WHERE N_loteria =".$nombre_loteria);
            }
            //Tres Digitos
            else{
              $ultimo_dato = mysqli_query($enlace, "SELECT ultimo_ingreso_3dig form datos_3dig WHERE N_loteria =". $nombre_loteria);
              if ($ultimo_dato < 1000) {
                $nuevo_dato = $ultimo_dato + 1;
              }
              else {
                $nuevo_dato = 1;
              }
              mysqli_query($enlace, "UPDATE datos_3dig SET dig".$nuevo_dato."=".$_POST['valor']."WHERE N_loteria =".$nombre_loteria);
            }
          }
        ?>
        <div class="Dos">
          <h2>Datos de Terminales de Dos Digitos:</h2>
        </div>
        <div class="Tres">
          <h2>Datos de Terminales de Tres Digitos:</h2>
        </div>
      </div>
    </div>
  </body>
</html>
