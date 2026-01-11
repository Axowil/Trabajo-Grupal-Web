<?php
// Iniciar sesión si no está iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verificar si hay usuario logueado
$usuarioLogueado = isset($_SESSION['usuario']);
$nombreUsuario = '';

// Si hay usuario logueado, obtener su información
if ($usuarioLogueado) {
    include_once 'config.php';
    $usuarioId = $_SESSION['usuario'];
    $sql = "SELECT email FROM usuarios WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $usuarioId);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($row = $result->fetch_assoc()) {
        // Extraer el nombre del email (parte antes del @)
        $nombreUsuario = explode('@', $row['email'])[0];
    }
}
?>

<nav class="navbar">
    <div class="navbar-container">
        <div class="navbar-logo">
            <a href="index.php">
                <img src="Imagenes/futbol.webp" alt="Logo Fútbol" class="logo-img">
            </a>
        </div>
        <ul class="navbar-menu">
            <li><a href="index.php">Inicio</a></li>
            <li><a href="canchas.php">Canchas</a></li>
            <li><a href="reserva.php">Reservar</a></li>
            <li><a href="contactanos.php">Contacto</a></li>
            <li><a href="sobreNosotros.php">Sobre Nosotros</a></li>
        </ul>
        <div class="navbar-buttons">
            <?php if ($usuarioLogueado): ?>
                <!-- Usuario logueado -->
                <span class="user-welcome">
                     Hola, <strong><?php echo htmlspecialchars($nombreUsuario); ?></strong>
                </span>
                <a href="logout.php" class="btn-logout">Cerrar Sesión</a>
            <?php else: ?>
                <!-- Usuario no logueado -->
                <a href="login.html" class="btn-login">Iniciar Sesión</a>
                <a href="register.html" class="btn-registro">Registrarse</a>
            <?php endif; ?>
        </div>
    </div>
</nav>