<?php
session_start();

/*
  PROTECCIÓN DE RESERVAS
  - Si el usuario NO inició sesión
  - se lo redirige al login
*/
if (!isset($_SESSION['usuario'])) {
    header("Location: login.html");
    exit;
}
?>





<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Reservar cancha</title>
  <link rel="stylesheet" href="css/styles.css">
  <link rel="stylesheet" href="css/reserva.css">
</head>
<body>
  <!-- Navbar con temática de fútbol -->
    <nav class="navbar">
        <div class="navbar-container">
            <div class="navbar-logo">
                <a href="#">
                    <img src="Imagenes/futbol.webp" alt="Logo Fútbol" class="logo-img">
                </a>
            </div>
            <ul class="navbar-menu">
                <li><a href="index.html">Inicio</a></li>
                <li><a href="canchas.html">Canchas</a></li>
                <li><a href="reserva.html">Reservar</a></li>
                <li><a href="contactanos.html">Contacto</a></li>
                <li><a href="sobreNosotros.html">Sobre Nosotros</a></li>
            </ul>
            <div class="navbar-buttons">
                <a href="login.html" class="btn-login">Iniciar Sesión</a>
                <a href="register.html" class="btn-registro">Registrarse</a>
            </div>
        </div>
    </nav>

  <header class="hero">
    <div class="hero-overlay"></div>
    <div class="hero-inner">
      <h1>Reserva tu cancha</h1>
      <p>Elige fecha y horario; te mostramos costo y disponibilidad.</p>
    </div>
  </header>

  <main class="wrapper">
    <form class="reserva-form" id="formReserva">
      <fieldset class="fieldset">
        <legend>Datos de la reserva</legend>

        <div class="grid">
          <div class="field">
            <label for="cancha">Cancha</label>
            <select id="cancha" required>
              <option value="" disabled selected>Selecciona una cancha</option>
              <option value="El Coloso Club V.C.">El Coloso Club V.C.</option>
              <option value="FRANCISCO'S CLUB">FRANCISCO'S CLUB</option>
              <option value="Canchas Sinteticas El Nacional de la Dolores">Canchas Sinteticas El Nacional de la Dolores</option>
              <option value="JARAWA SPORT S.A.C.">JARAWA SPORT S.A.C.</option>
              <option value="Canchas sintéticas Arequipa - Club Las Pampas">Canchas sintéticas Arequipa - Club Las Pampas</option>
              <option value="El Clásico - Cancha Sintética">El Clásico - Cancha Sintética</option>
              <option value="Olympus Tennis Camps">Olympus Tennis Camps</option>
              <option value="Canchas sintéticas EL GOLAZO">Canchas sintéticas EL GOLAZO</option>
              <option value='Cancha Sintética "San Siro"'>Cancha Sintética "San Siro"</option>
            </select>
          </div>

          <div class="field">
            <label for="fecha">Fecha</label>
            <input type="date" id="fecha" required>
          </div>

          <div class="field">
            <label for="horaInicio">Hora de inicio</label>
            <input type="time" id="horaInicio" step="300" required>
          </div>

          <div class="field">
            <label for="horaFin">Hora de fin</label>
            <input type="time" id="horaFin" step="300" required>
          </div>
        </div>
      </fieldset>

      <fieldset class="fieldset">
        <legend>Horas de reserva y costo</legend>
        <div class="grid">
          <div class="field">
            <label for="tarifaHora">Tarifa (S/ por hora)</label>
            <input type="text" id="tarifaHora" readonly placeholder="—">
          </div>

          <div class="field">
            <label for="horasTotales">Horas totales</label>
            <input type="text" id="horasTotales" readonly placeholder="0.00">
          </div>

          <div class="field">
            <label for="totalPagar">Total a pagar (S/)</label>
            <input type="text" id="totalPagar" readonly placeholder="0.00">
          </div>
        </div>

        <div class="acciones">
          <button type="button" id="btnCalcular">Calcular costo</button>
          <button type="button" id="btnDisponibilidad">Consultar disponibilidad</button>
        </div>

        <p id="estadoDisponibilidad" class="estado"></p>
      </fieldset>

      <div class="submitRow">
        <button type="submit" class="btn-primary">Confirmar reserva</button>
      </div>
    </form>
  </main>

  <!-- ================= CHATBOT ================= -->
  <button class="chatbot-fab" id="chatbotFab" aria-label="Abrir chatbot">🤖</button>

  <div class="chatbot-panel" id="chatbotPanel" aria-hidden="true">
  <div class="chatbot-header">
      <div class="chatbot-title">
      <span class="chatbot-badge">Asistente</span>
      <strong>Reservas</strong>
      <small>Respuestas rápidas</small>
      </div>
      <div class="chatbot-actions">
      <button class="chatbot-icon-btn" id="chatbotMin" title="Minimizar">—</button>
      <button class="chatbot-icon-btn" id="chatbotClose" title="Cerrar">✕</button>
      </div>
  </div>

  <div class="chatbot-body" id="chatbotMsgs"></div>

  <div class="chatbot-chips">
      <button class="chatbot-chip" data-q="Hola">Hola</button>
      <button class="chatbot-chip" data-q="¿Cómo reservo una cancha?">¿Cómo reservo?</button>
      <button class="chatbot-chip" data-q="¿Qué canchas hay?">¿Qué canchas hay?</button>
      <button class="chatbot-chip" data-q="Horarios disponibles">Horarios</button>
  </div>

  <form class="chatbot-input" id="chatbotForm">
      <input id="chatbotText" type="text" placeholder="Escribe tu mensaje..." autocomplete="off" />
      <button type="submit">Enviar</button>
  </form>
  </div>
  
  <footer class="footer">
    <div class="footer-container">
      <div class="footer-info">
        <h2 class="footer-logo">Reservas de Canchas Web</h2>
        <p class="footer-description">
          Tu plataforma para reservar canchas deportivas fácilmente. 
          Conectamos deportistas con las mejores instalaciones deportivas de la ciudad.
        </p>
      </div>

      <div class="footer-section">
        <h3>Enlaces Rápidos</h3>
        <ul class="footer-links">
          <li><a href="index.html">Inicio</a></li>
          <li><a href="canchas.html">Canchas</a></li>
          <li><a href="reserva.html">Reservar</a></li>
          <li><a href="contactanos.html">Contacto</a></li>
          <li><a href="#terminos">Términos</a></li>
          <li><a href="#privacidad">Privacidad</a></li>
        </ul>
      </div>

      <div class="footer-section">
            <h3>Síguenos</h3>
            <div class="social-links">
                <a href="#" class="social-link facebook" title="Facebook">
                    <img src="iconos/facebook.svg" alt="Facebook" width="24" height="24">
                </a>
                <a href="#" class="social-link instagram" title="Instagram">
                    <img src="iconos/instagram.svg" alt="Instagram" width="24" height="24">
                </a>
                <a href="#" class="social-link twitter" title="X/Twitter">
                    <img src="iconos/twitter.svg" alt="Twitter" width="24" height="24">
                </a>
            </div>
        </div>

      <div class="footer-section">
        <h3>Contacto</h3>
        <div class="contact-info">
          <div class="contact-item">
            <span class="contact-icon">
              <img src="iconos/email.svg" alt="correo">
            </span>
            <span>contacto@reservewebstadium.com</span>
          </div>
          <div class="contact-item">
            <span class="contact-icon">
              <img src="iconos/telefono.svg" alt="telefono">
            </span>
            <span>+51 987 654 321</span>
          </div>
        </div>
      </div>
    </div>

    <div class="footer-bottom">
      <p>&copy; 2025 Reservas de Canchas Web. Todos los derechos reservados.</p>
    </div>
  </footer>
  <script src="js/reserva.js"></script>
  <script src="js/chatbot.js"></script>
</body>
</html>
