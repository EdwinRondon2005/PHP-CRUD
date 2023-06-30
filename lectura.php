<!DOCTYPE html>
<html>
  <meta charset = "UTF-8">
    <head>
      <title>Visualización de aparatos</title>
      <link rel = "stylesheet" href = "Vista.css">
    </head>
  <body>
  <?php
    // Conexión a la base de datos.
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "electrodomesticos";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar conexión.
    if ($conn->connect_error) 
    {
      die("Conexión fallida: " . $conn->connect_error);
    }

    // Obtener los datos de la tabla.
    $sql = "SELECT * FROM datos";
    $result = $conn->query($sql);

    // Crear la tabla HTML para mostrar los datos.
    if ($result->num_rows > 0) 
    {
      echo '<div class="container">';
      echo '<h1 class="title"> Lista de electrodomésticos</h1>';
      echo '<hr>';
      echo '<br>';
      echo '<table border = 1>';
      echo '<thead>';
      echo '<tr>';
      echo '<th>Código</th>';
      echo '<th>Nombre</th>';
      echo '<th>Precio</th>';
      echo '<th>Descripción</th>';
      echo '<th>Proveedor</th>';
      echo '</tr>';
      echo '</thead>';
      echo '<tbody>';
      // Recorrer los resultados y mostrarlos en la tabla.
      while($row = $result->fetch_assoc()) 
      {
        echo '<tr>';
        echo '<td>' . $row["codigo"] . '</td>';
        echo '<td>' . $row["nombre"] . '</td>';
        echo '<td>' . $row["precio"] . '</td>';
        echo '<td>' . $row["descripcion"] . '</td>';
        echo '<td>' . $row["proveedor"] . '</td>';
        echo '</tr>';
      }
      echo '</tbody>';
      echo '</table>';
      echo '</div>';
    } 
    else 
    {
      echo '<p>No se encontraron datos.</p>';
    }
    $conn->close();
  ?>
  <br><br><br><br>
    <ul>
      <li><a href = "menu.html">Volver al menú principal</a></li>
    </ul>
  </body>
</html>