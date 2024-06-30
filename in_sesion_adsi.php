<?php
session_start();

$servername = "localhost";
$username = "root";
$password = ""; 
$dbname = "adsi";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['user']) && isset($_POST['contraseña'])) {
        $user = $_POST['user'];
        $contraseña = $_POST['contraseña'];

        $sql = "SELECT * FROM usuario WHERE user = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $user);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if ($row['contraseña'] == $contraseña) {
                $_SESSION['user'] = $row['user'];
                $_SESSION['rol'] = $row['rol'];

                if ($_SESSION['rol'] == 'admin') {
                    header("Location: registro_estudiante.php"); 
                } else {
                    header("Location: registro_adsi.html"); 
                }
                exit();
            } else {
                echo "Contraseña incorrecta.";
            }
        } else {
            echo "Usuario no encontrado.";
        }

        $stmt->close();
    }
}

$conn->close();
?>

