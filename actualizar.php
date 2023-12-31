<!DOCTYPE html>
<html>
  <meta charset = "UTF-8">
    <head>
      <title>Actualizar los registros</title>
      <link rel = "stylesheet" href = "Vista.css">
    </head>
  <body>
    <h1>Actualizar registros</h1>
    <hr>
    <br><br><br><br>
    <ul>
      <li><a href="menu.html">volver al menu principal</a></li>
    </ul>
  </body>
</html>
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

  // Obtener los datos de la tabla "datos".
  $sql = "SELECT * FROM datos";
  $result = $conn->query($sql);

  // Crear la tabla y los botones de actualizar.
  if ($result->num_rows > 0) 
  {
    echo "<table>";
    echo "<tr><th>codigo</th><th>nombre</th><th>precio</th><th>descripcion</th><th>proveedor</th><th>Actualizar</th></tr>";
    
    while($row = $result->fetch_assoc()) 
    {
      echo "<tr>";
      echo "<td>".$row["codigo"]."</td>";
      echo "<td>".$row["nombre"]."</td>";
      echo "<td>".$row["precio"]."</td>";
      echo "<td>".$row["descripcion"]."</td>";
      echo "<td>".$row["proveedor"]."</td>";
        
      echo "<td>
            <form action='' method='post'>
              <input type='hidden' name='codigo' value='".$row["codigo"]."'>
              <input type='submit' name='update' value='Actualizar'>
            </form>
            </td>";
      echo "</tr>";
    }

    echo "</table>";
  } 
  else 
  {
    echo "No se encontraron registros.";
  }

  // Cerrar la conexión a la base de datos.
  $conn->close();

    // Si se ha pulsado el botón de actualizar, mostrar el formulario.
  if(isset($_POST['update']))
  {
    $codigo = $_POST['codigo'];
    $conn = new mysqli($servername, $username, $password, $dbname);
    $sql = "SELECT * FROM datos WHERE codigo='$codigo'";
    $result = $conn->query($sql);
  
    if ($result->num_rows > 0) 
    {
      $row = $result->fetch_assoc();
      echo "<h2>Actualizar registro</h2>";
      echo "<form action='' method='post'>";
      echo "<label>Codigo:</label><br>";
      echo "<input type='text' name='codigo' value='".$row["codigo"]."'><br>";
      echo "<label>nombre</label><br>";
      echo "<input type='text' name='nombre' value='".$row["nombre"]."'><br>";
      echo "<label>precio:</label><br>";
      echo "<input type='text' name='precio' value='".$row["precio"]."'><br>";
      echo "<label>descripcion:</label><br>";
      echo "<input type='text' name='descripcion' value='".$row["descripcion"]."'><br>";
      echo "<label>proveedor:</label><br>";
      echo "<input type='text' name='proveedor' value='".$row["proveedor"]."'><br>";

      echo "<input type='submit' name='submit' value='Actualizar'>";
      echo "</form>";
    }
    $conn->close();
  }

  // Si se ha enviado el formulario de actualización, actualizar los datos en la base de datos.
  if(isset($_POST['submit']))
  {
    $codigo = $_POST['codigo'];
    $nombre= $_POST['nombre'];
    $precio = $_POST['precio'];
    $descripcion = $_POST['descripcion'];
    $proveedor = $_POST['proveedor'];
  
    $conn = new mysqli($servername, $username, $password, $dbname);
    $sql = "UPDATE datos SET codigo='$codigo', nombre='$nombre', precio='$precio', descripcion='$descripcion',proveedor='$proveedor'";
    if ($conn->query($sql) === TRUE) 
    {
      echo "Registro actualizado correctamente. Actualiza la página si no se han cambiado los valores.";
    } 
    else 
    {
      echo "Error al actualizar el registro: " . $conn->error;
    }
    $conn->close();
  }
?>