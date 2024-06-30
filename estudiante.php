<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Estudiante</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 20px;
        }
        h1 {
            margin-bottom: 20px;
            color: #007bff;
        }
        .form-control {
            margin-bottom: 10px;
        }
        .table {
            margin-top: 20px;
        }
        .alert {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-center">Estudiantes <span class="subtitulo"></span></h1>

        <?php
        $conexion = new mysqli("localhost", "root", "", "adsi");

        if ($conexion->connect_error) {
            die("Error de conexión" . $conexion->connect_error);
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];
            $user = $_POST['user'];
            $programa = $_POST['programa'];
            $calificacion = $_POST['calificacion'];

            $insertar = "INSERT INTO usuario (nombre, apellido, user, programa, calificacion) VALUES ('$nombre', '$apellido', '$user', '$programa', '$calificacion')";

            if ($conexion->query($insertar) === TRUE) {
                header("Location: {$_SERVER['PHP_SELF']}");
            } else {
                echo "<div class='alert alert-danger' role='alert'>Error: " . $insertar . "<br>" . $conexion->error . "</div>";
            }
        }

        $consulta = "SELECT * FROM usuario WHERE rol != 'admin' ORDER BY rol DESC, id ASC";
        $resultado = $conexion->query($consulta);

        if ($resultado->num_rows > 0) {
            $registro = $resultado->fetch_all(MYSQLI_ASSOC);
        } else {
            $registro = [];
        }
        ?>



        <div class="row">
            <div class="col-md-12">
                <table class="table table-hover table-bordered border-primary text-center">
                    <thead class="thead-dark">
                        <tr>
                            <th>Id</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>User</th>
                            <th>Programa</th>
                            <th>Calificación</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($registro as $persona): ?>
                            <tr>
                                <td><?php echo $persona['id']; ?></td>
                                <td><?php echo $persona['nombre']; ?></td>
                                <td><?php echo $persona['apellido']; ?></td>
                                <td><?php echo $persona['user']; ?></td>
                                <td><?php echo $persona['programa']; ?></td>
                                <td><?php echo $persona['calificacion']; ?></td>
                                
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <a href="in_sesion_adsi.html" class="btn btn-primary">Salir</a>
            </div>
        </div>
        
    </div>

        

        
        <?php $conexion->close(); ?>

    </div>

</body>
</html>
