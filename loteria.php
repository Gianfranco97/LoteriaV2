<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Estadísticas</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/estilos.css">
    <?php
      require 'conex.php';
      $nombre_loteria = $_GET['nombre'];
    ?>
  </head>
  <body>
    <?php
      echo "<h1>Bienvenido a las estadísticas de ". $nombre_loteria ."</h1>";
      echo "<a href='index.php'><h2 class='regreso'>Regresar a la Pagina de Inicio</h2></a>";
      echo"<form class='formulario_nuevo' action='loteria.php?nombre=$nombre_loteria' method='post'>
      <h2>Agregar datos nuevos</h2>
      <p><strong>Tipo de dato:</strong></p><br>
      Dos digitos<input type='radio' name='tipo_dato' value='2' required>
      Tres digitos<input type='radio' name='tipo_dato' value='3' required>
      <p><strong>Valor:</strong></p>
      <input type='number' name='valor'>
      </br>
      <input class='boton' type='submit' name='boton' value='enviar'>
      </form>";
      echo"<form class='formulario_nuevo' action='loteria.php?nombre=$nombre_loteria' method='post'>
      <h2>Cambiar un Dato Existente:</h2>
      <p><strong>Tipo de dato:</strong></p><br>
      Dos digitos<input type='radio' name='tipo_dato' value='2' required>
      Tres digitos<input type='radio' name='tipo_dato' value='3' required>
      <p><strong>Código:</strong></p>
      <input type='number' name='codigo'>
      <p><strong>Nuevo Valor:</strong></p>
      <input type='number' name='valor'>
      </br>
      <input class='boton' type='submit' name='boton' value='Cambiar'>
      </form>";
    ?>
      <div class="Datos">
        <?php
          $sqlTres = mysqli_query($enlace, "SELECT * FROM datos_3dig WHERE N_loteria ='$nombre_loteria'");
          $tresDigitos = mysqli_fetch_assoc($sqlTres);
          $sqlDos = mysqli_query($enlace, "SELECT * FROM datos_2dig WHERE N_loteria ='$nombre_loteria'");
          $dosDigitos = mysqli_fetch_assoc($sqlDos);
          if (isset($_POST['boton'])) {
            //Dos Digitos
              if ($_POST['tipo_dato'] == 2) {
                if (isset($_POST['codigo'])) {
                  $nuevo_dato = $_POST['codigo'];
                }
                elseif (isset($_POST['valor'])) {
                  if ($dosDigitos['ultimo_ingreso_2dig'] < 100) {
                    $nuevo_dato = $dosDigitos['ultimo_ingreso_2dig'] + 1;
                  }
                  else {
                    $nuevo_dato = 1;
                  }
                  mysqli_query($enlace, "UPDATE datos_2dig SET ultimo_ingreso_2dig=".$nuevo_dato." WHERE N_loteria ='".$nombre_loteria."'");
                }
                mysqli_query($enlace, "UPDATE datos_2dig SET dig".$nuevo_dato."=".$_POST['valor']." WHERE N_loteria ='".$nombre_loteria."'");
            }
            //Tres Digitos
            else{
                  if (isset($_POST['codigo'])) {
                    $nuevo_dato = $_POST['codigo'];
                  }
                  elseif (isset($_POST['valor'])) {
                    if ($tresDigitos['ultimo_ingreso_3dig'] < 1000) {
                      $nuevo_dato = $tresDigitos['ultimo_ingreso_3dig'] + 1;
                    }
                    else {
                      $nuevo_dato = 1;
                    }
                    mysqli_query($enlace, "UPDATE datos_3dig SET ultimo_ingreso_3dig=".$nuevo_dato." WHERE N_loteria ='".$nombre_loteria."'");
                  }
                  mysqli_query($enlace, "UPDATE datos_3dig SET dig".$nuevo_dato."=".$_POST['valor']." WHERE N_loteria ='".$nombre_loteria."'");
              }
            echo "<META HTTP-EQUIV='REFRESH' CONTENT='0.1;URL=loteria.php?nombre=$nombre_loteria'>";
          }
        ?>
        <div class="resultados">
          <h2>Datos de Terminales de Dos Digitos:</h2>
            <?php
            //calculando los repetidos
            for ($i=0; $i < 100; $i++) {
              $repetido[$i] = 0;
            }
            for ($i=1; $i <= 100; $i++) {
              for ($e=0; $e < 100; $e++) {
                if ($dosDigitos["dig$i"] == $e) {
                  $repetido[$e] ++;
                }
              }
            }
            //mostrando los repetidos
            echo "<div class='lista'><h3>Numeros repetidos:</h3></br><ul>";
            for ($i=0; $i < 100; $i++) {
              if ($repetido[$i] > 0) {
                echo "<li>$i: $repetido[$i]</li>";
              }
            }
            //numeros faltes
            echo "</ul></br></div><div class='lista'><h3>Numeros Faltantantes:</h3></br><ul>";
            for ($i=0; $i < 100; $i++) {
              if ($repetido[$i] == 0) {
                echo "<li>$i</br></li>";
              }
            }
            echo "</ul></div>";
            echo "<h2>Todos los registros</h2></br><p>El codigo del ultimo dato ingresado es: ".$dosDigitos['ultimo_ingreso_2dig']."</P><br><div class='lista'></br><ul>";
            //lista de todos los datos
              for ($i=1; $i <= 100; $i++) {
                echo '<li>Cod:'.$i.' - '.$dosDigitos["dig$i"].'</li></br>';
              }
              echo "</ul></div></br>";
            ?>
        </div>
        <div class="resultados">
          <h2>Datos de Terminales de Tres Digitos:</h2>
          <?php
          //calculando los repetidos
          for ($i=0; $i < 1000; $i++) {
            $repetido[$i] = 0;
          }
          for ($i=1; $i <= 1000; $i++) {
            for ($e=0; $e < 1000; $e++) {
              if ($tresDigitos["dig$i"] == $e) {
                $repetido[$e] ++;
              }
            }
          }
          //mostrando los repetidos
          echo "<div class='lista'><h3>Numeros repetidos:</h3></br><ul>";
          for ($i=0; $i < 1000; $i++) {
            if ($repetido[$i] > 0) {
              echo "<li>$i: $repetido[$i]</li>";
            }
          }
          //numeros faltes
          echo "</ul></br></div><div class='lista'><h3>Numeros Faltantantes:</h3></br><ul>";
          for ($i=0; $i < 1000; $i++) {
            if ($repetido[$i] == 0) {
              echo "<li>$i</br></li>";
            }
          }
          echo "</ul></br></div>";
          echo "<h2>Todos los registros</h2></br><p>El codigo del ultimo dato ingresado es: ".$tresDigitos['ultimo_ingreso_3dig']."</P><br><div class='lista'></br><ul>";
          //lista de todos los datos
            for ($i=1; $i <= 1000; $i++) {
              echo '<li>Cod:'.$i.' - '.$tresDigitos["dig$i"].'</li></br>';
            }
            echo "</ul></div></br>";
          ?>
        </div>
      </div>
  </body>
</html>
