<?php
// Se incluye la conexión a la base de datos
include "config.php";

// Se inicia una sesión para mantener al usuario logueado
session_start();

// Se reciben los datos enviados desde el formulario
$email = $_POST['email'];
$password = $_POST['password'];

// Consulta para buscar el usuario por correo
$sql = "SELECT id, password FROM usuarios WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

// Se verifica si el usuario existe
if ($row = $result->fetch_assoc()) {

    // Se compara la contraseña ingresada con la encriptada en la BD
    if (password_verify($password, $row['password'])) {

        // Si es correcta, se guarda el id del usuario en sesión
        $_SESSION['usuario'] = $row['id'];

        // Se redirige al inicio
        header("Location: index.html");
        exit;

    } else {
        // Contraseña incorrecta
        echo "Contraseña incorrecta";
    }

} else {
    // Usuario no encontrado
    echo "El usuario no existe";
}
?>
