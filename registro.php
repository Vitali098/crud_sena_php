<?php
$servername = "localhost";
$username = "root";
$password = ""; 
$dbname = "adsi";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $contraseña = $_POST['contraseña'];
    $user = $_POST['user'];
    $programa = $_POST['programa'];
    $rol = $_POST['rol'];

    $sql = "INSERT INTO usuario (nombre, apellido, contraseña, user, programa, rol) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $nombre, $apellido, $contraseña, $user, $programa, $rol);

    if ($stmt->execute()) {
        header("Location: in_sesion_adsi.html");
        exit();
    } else {
        echo "Error " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>


