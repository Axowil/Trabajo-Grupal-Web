<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "futbol_web";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Error de conexión");
}
?>
