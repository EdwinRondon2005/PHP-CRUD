<!DOCTYPE html>
<html>
  <meta charset = "UTF-8">
    <head>
      <title>Leer o borrar datos de los electrodomésticos registrados</title>
      <link rel = "stylesheet" href = "Vista.css">
    </head>
  <body>
    <h1>Leer o borrar datos</h1>
    <hr>
    <br>
    <table border = "1">
      <tr>
        <th>Código</th>
        <th>Nombre</th>
        <th>Precio</th>
        <th>Descripcion</th>
        <th>Proveedor</th>
        <th>Borrar</th>
      </tr>
      <?php
        // Conectarse a la base de datos.
        $conexion = mysqli_connect("localhost", "root", "", "electrodomesticos");

        // Verificar si la conexión fue exitosa.
        if (!$conexion) 
        {
          die("Error de conexión: " . mysqli_connect_error());
        }

        // Verificar si se ha enviado un ID de registro para borrar.
        if (isset($_GET["borrar"])) 
        {
          $codigo = $_GET["borrar"];
          $consulta = "DELETE FROM datos WHERE codigo = $codigo";
          $resultado = mysqli_query($conexion, $consulta);

          // Verificar si el borrado fue exitoso.
          if ($resultado) 
          {
            echo "<p style = 'text-align:center'>¡Registro borrado exitosamente!</p>";
          } 
          else 
          {
            echo "Error al borrar el registro: " . mysqli_error($conexion);
          }
        }

        // Consultar los datos de la tabla.
        $consulta = "SELECT codigo, nombre, descripcion, proveedor, precio FROM datos";
        $resultado = mysqli_query($conexion, $consulta);
        // Verificar si la consulta fue exitosa.
        if (!$resultado) 
        {
          die("Error de consulta: " . mysqli_error($conexion));
        }

        // Mostrar los datos en una tabla HTML.
        while ($fila = mysqli_fetch_assoc($resultado)) 
        {
          echo "<tr>";
          echo "<td>" . $fila["codigo"] . "</td>";
          echo "<td>" . $fila["nombre"] . "</td>";
          echo "<td>" . $fila["precio"] . "</td>";
          echo "<td>" . $fila["descripcion"] . "</td>";
          echo "<td>" . $fila["proveedor"] . "</td>";
          echo "<td><a href=\"?borrar=" . $fila["codigo"] . "\">Borrar</a></td>";
          echo "</tr>";
        }

        // Cerrar la conexión a la basede datos.
        mysqli_close($conexion);
      ?>
    </table>
    <br><br><br><br>
    <ul>
      <li><a href = "menu.html">Volver al menú principal</a></li>
    </ul>
  </body>
</html>