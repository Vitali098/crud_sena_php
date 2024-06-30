<!DOCTYPE html>
<html>
<head>
    <title>Estadisticas</title>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 20px;
        }
        h2 {
            color: #007bff;
            margin-bottom: 20px;
        }
        table {
            width: 50%;
            margin: 0 auto;
            border-collapse: collapse;
            border: 2px solid #007bff;
        }
        th, td {
            padding: 10px;
            text-align: center;
            border: 1px solid #ddd;
        }
        th {
            background-color: #007bff;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #ddd;
        }
        .container {
            text-align: center;
            margin-top: 20px;
        }
        .btn {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            text-align: center;
            display: inline-block;
            font-size: 16px;
            margin-top: 20px;
            cursor: pointer;
            border-radius: 5px;
            text-decoration: none;
        }
        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Estadisticas por programa</h2>

    <?php
    $conexion = new mysqli("localhost", "root", "", "adsi");

    if ($conexion->connect_error) {
        die("Error en la conexión: " . $conexion->connect_error);
    }

    $sql = "SELECT programa, COUNT(*) as cantidad_estudiantes FROM usuario GROUP BY programa";

    $resultado = $conexion->query($sql);

    if ($resultado->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>Programa</th><th>Cantidad de Estudiantes</th></tr>";
        while ($fila = $resultado->fetch_assoc()) {
            echo "<tr><td>" . $fila["programa"] . "</td><td>" . $fila["cantidad_estudiantes"] . "</td></tr>";
        }
        echo "</table>";
    } else {
        echo "No hay usuarios registrados";
    }

    $conexion->close();
    ?>

    <a href="admin.php" class="btn">Volver a Infomación General</a>
</div>


</body>
</html>
