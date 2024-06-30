<?php
include("conexion.php");

if (!isset($_POST['bot_actualizar'])) {
    $id = isset($_GET['id']) ? $_GET['id'] : '';
    $nombre = isset($_GET['nombre']) ? $_GET['nombre'] : '';
    $apellido = isset($_GET['apellido']) ? $_GET['apellido'] : '';
    $programa = isset($_GET['programa']) ? $_GET['programa'] : '';
    $calificacion = isset($_GET['calificacion']) ? $_GET['calificacion'] : '';
    $prev_url = isset($_GET['prev_url']) ? $_GET['prev_url'] : 'registro_estudiante.php';
} else {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $programa = $_POST['programa'];
    $calificacion = $_POST['calificacion'];
    $prev_url = $_POST['prev_url'];

    $sql = "UPDATE usuario SET nombre = :nombre, apellido = :apellido, programa = :programa, calificacion = :calificacion WHERE id = :id";
    $resultado = $objeto->prepare($sql);
    $resultado->execute(array(":id" => $id, ":nombre" => $nombre, ":apellido" => $apellido, ":programa" => $programa, ":calificacion" => $calificacion));

    header("Location: $prev_url");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Actualizar Estudiante</title>
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
        .btn {
            width: 100%;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-center">Actualizar Estudiante</h1>

        <form name="form1" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="table table-hover table-bordered border-primary text-center p-3 bg-white shadow rounded">
            <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
            <input type="hidden" name="prev_url" value="<?php echo $prev_url; ?>">
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" id="nombre" class="form-control" value="<?php echo $nombre; ?>" required>
            </div>
            <div class="form-group">
                <label for="apellido">Apellido</label>
                <input type="text" name="apellido" id="apellido" class="form-control" value="<?php echo $apellido; ?>" required>
            </div>
            <div class="form-group">
                <label for="programa">Programa</label>
                <select name="programa" id="programa" class="form-control" required <?php if ($programa == 'admin') echo 'disabled'; ?>>
                    <option value="">Seleccione...</option>
                    <option value="Análisis y Desarrollo de Software" <?php if ($programa == 'Análisis y Desarrollo de Software') echo 'selected'; ?>>Análisis y Desarrollo de Software</option>
                    <option value="Artes Gráficas" <?php if ($programa == 'Artes Gráficas') echo 'selected'; ?>>Artes Gráficas</option>
                    <option value="Gestión" <?php if ($programa == 'Gestión') echo 'selected'; ?>>Gestión</option>
                </select>
            </div>
            <?php if ($programa != 'admin'): ?>
            <div class="form-group">
                <label for="calificacion">Calificación</label>
                <input type="text" name="calificacion" id="calificacion" class="form-control" value="<?php echo $calificacion; ?>" required>
            </div>
            <?php endif; ?>
            <div class="form-group">
                <input type="submit" class="btn btn-success" name="bot_actualizar" id="bot_actualizar" value="Actualizar">
            </div>
        </form>
    </div>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
   
</body>
</html>


