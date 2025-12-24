<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

$host = "sql308.infinityfree.com";
$user = "if0_40752334";
$pass = "TU_PASSWORD_DE_VPANEL";
$db   = "if0_40752334_futbol_web";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
?>
