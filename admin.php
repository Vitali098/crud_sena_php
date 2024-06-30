<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Administrador</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }
        .container {
            margin-top: 30px;
        }
        h1 {
            margin-bottom: 30px;
            color: #007bff;
            font-size: 36px;
            font-weight: bold;
        }
        .form-control {
            margin-bottom: 20px;
        }
        .table {
            margin-top: 30px;
        }
        .alert {
            margin-top: 20px;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }
        .btn-danger:hover {
            background-color: #c82333;
            border-color: #bd2130;
        }
        .btn-warning {
            background-color: #ffc107;
            border-color: #ffc107;
        }
        .btn-warning:hover {
            background-color: #e0a800;
            border-color: #d39e00;
        }
        .thead-dark th {
            background-color: #343a40;
            color: #fff;
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
            $calificacion = isset($_POST['calificacion']) ? $_POST['calificacion'] : '';
            $contraseña = $_POST['contraseña'];

            $insertar = "INSERT INTO usuario (nombre, apellido, user, programa, calificacion, contraseña) VALUES ('$nombre', '$apellido', '$user', '$programa', '$calificacion' , '$contraseña')";

            if ($conexion->query($insertar) === TRUE) {
                header("Location: {$_SERVER['PHP_SELF']}");
            } else {
                echo "<div class='alert alert-danger' role='alert'>Error: " . $insertar . "<br>" . $conexion->error . "</div>";
            }
        }

        $consulta = "SELECT * FROM usuario ORDER BY rol DESC, id ASC";
        $resultado = $conexion->query($consulta);

        if ($resultado->num_rows > 0) {
            $registro = $resultado->fetch_all(MYSQLI_ASSOC);
        } else {
            $registro = [];
        }
        ?>

        <div class="row mb-4">
            <div class="col-md-12">
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre" required>
                        </div>
                        <div class="form-group col-md-3">
                            <input type="text" class="form-control" name="apellido" id="apellido" placeholder="Apellido" required>
                        </div>
                        <div class="form-group col-md-3">
                            <input type="text" class="form-control" name="user" id="user" placeholder="User" required>
                        </div>
                        <div class="form-group col-md-3">
                            <input type="password" class="form-control" name="contraseña" id="contraseña" placeholder="Contraseña" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <select class="form-control" name="programa" id="programa" required>
                                <option value="">Seleccione un programa...</option>
                                <option value="Análisis y Desarrollo de Software">Análisis y Desarrollo de Software</option>
                                <option value="Artes Gráficas">Artes Gráficas</option>
                                <option value="Gestión">Gestión</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <input type="number" class="form-control" name="calificacion" id="calificacion" placeholder="Calificación" required>
                        </div>
                        <div class="form-group col-md-4">
                            <button type="submit" class="btn btn-primary btn-block">Insertar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

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
                            <th>Rol</th>
                            <th>Contraseña</th>
                            <th>Acciones</th>
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
                                <td><?php echo $persona['rol']; ?></td>
                                <td><?php echo $persona['contraseña']; ?></td>
                                <td>
                                    <?php if ($persona['programa'] != 'admin'): ?>
                                        <a href="eliminar.php?id=<?php echo $persona['id']; ?>" class="btn btn-danger btn-sm">Borrar</a>
                                        <a href="actualizar.php?id=<?php echo $persona['id']; ?>&nombre=<?php echo $persona['nombre']; ?>&apellido=<?php echo $persona['apellido']; ?>&user=<?php echo $persona['user']; ?>&programa=<?php echo $persona['programa']; ?>&calificacion=<?php echo $persona['calificacion']; ?>&contraseña=<?php echo $persona['contraseña']; ?>&prev_url=<?php echo urlencode($_SERVER['REQUEST_URI']); ?>" class="btn btn-warning btn-sm">Actualizar</a>
                                    <?php else: ?>
                                        <span class="text-muted">No editable</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <a href="estadistica.php" class="btn btn-primary">Ver Estadísticas</a>
                <a href="in_sesion_adsi.html" class="btn btn-primary">Salir</a>
            </div>
        </div>

        <?php $conexion->close(); ?>

    </div>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>



