<?php
// Configuración de la conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = ""; // Sin contraseña
$database = "AGENCIA";

try {
    // Crear conexión utilizando PDO
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Conexión exitosa con PDO<br>";
} catch(PDOException $e) {
    echo "No Hay Conexión - ERROR: " . $e->getMessage();
}
?>
