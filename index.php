<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    
</head>
<body>
       <?php include 'navbar.php'; ?>


<div class="hero-section">
    <div class="hero-overlay"></div>
    <div class="hero-text-container">
        <h1>Encuentra tu cancha, reserva tu pasión.</h1>
        <p>Tu próximo partido empieza aquí. Reserva ahora.</p>
    </div>
</div>
<!-- Cierra la sección del Hero -->

<section class="canchas-section">
    <h2 class="section-title">Nuestras Canchas Disponibles</h2>
    <div class="canchas-grid-container">
        <div class="canchas-grid">

            <a href="https://maps.app.goo.gl/yrjiVN9TPq3Yjn6N8" target="_blank" rel="noopener" class="cancha-card">
                <img src="Imagenes/Coloso.jpg" alt="El Coloso Club V.C.">
                <div class="cancha-info">
                    <p>El Coloso Club V.C.</p>
                </div>
            </a>

            <a href="https://maps.app.goo.gl/YWKZHyKVAsgbeZSs6" target="_blank" rel="noopener" class="cancha-card">
                <img src="Imagenes/Francisco.png" alt="FRANCISCO'S CLUB">
                <div class="cancha-info">
                    <p>FRANCISCO'S CLUB</p>
                </div>
            </a>

            <a href="https://maps.app.goo.gl/mFvS3LyxkqA7yzRq5" target="_blank" rel="noopener" class="cancha-card">
                <img src="Imagenes/Nacional.webp" alt="Canchas Sinteticas El Nacional de la Dolores">
                <div class="cancha-info">
                    <p>Canchas Sinteticas El Nacional de la Dolores</p>
                </div>
            </a>

            <a href="https://maps.app.goo.gl/VmaMoW7rvfpxJFAbA" target="_blank" rel="noopener" class="cancha-card">
                <img src="Imagenes/jarawa.png" alt="JARAWA SPORT S.A.C.">
                <div class="cancha-info">
                    <p>JARAWA SPORT S.A.C.</p>
                </div>
            </a>

            <a href="https://maps.app.goo.gl/E6pH1dWj8ffsx5u18" target="_blank" rel="noopener" class="cancha-card">
                <img src="Imagenes/cancha-sintetica-arequipa.webp" alt="Canchas sintéticas Arequipa - Club Las Pampas">
                <div class="cancha-info">
                    <p>Canchas sintéticas Arequipa - Club Las Pampas</p>
                </div>
            </a>

            <a href="https://maps.app.goo.gl/1rEgYomdBF7oFurZ8" target="_blank" rel="noopener" class="cancha-card">
                <img src="Imagenes/el-clasico.webp" alt="El Clásico - Cancha Sintética">
                <div class="cancha-info">
                    <p>El Clásico - Cancha Sintética</p>
                </div>
            </a>

            <a href="https://maps.app.goo.gl/oX1TDMgonTscZUG68" target="_blank" rel="noopener" class="cancha-card">
                <img src="Imagenes/cancha-olympus.webp" alt="Olympus Tennis Camps">
                <div class="cancha-info">
                    <p>Olympus Tennis Camps</p>
                </div>
            </a>

            <a href="https://maps.app.goo.gl/ntssPJPm5PwQRrgEA" target="_blank" rel="noopener" class="cancha-card">
                <img src="Imagenes/el-golazo.webp" alt="Canchas sintéticas EL GOLAZO">
                <div class="cancha-info">
                    <p>Canchas sintéticas EL GOLAZO</p>
                </div>
            </a>

            <a href="https://maps.app.goo.gl/U6tt8erWcg43ucKe7" target="_blank" rel="noopener" class="cancha-card">
                <img src="Imagenes/Santiago.jpg" alt="Cancha Sintetica Santiago Bernabeu de Lanificio">
                <div class="cancha-info">
                    <p>Cancha Sintetica Santiago Bernabeu de Lanificio</p>
                </div>
            </a>

        </div>
    </div>
</section>

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

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-container">
            <!-- Información Principal -->
            <div class="footer-info">
                <h2 class="footer-logo">Reservas de Canchas Web</h2>
                <p class="footer-description">
                    Tu plataforma para reservar canchas deportivas fácilmente. 
                    Conectamos deportistas con las mejores instalaciones deportivas de la ciudad.
                </p>
            </div>

            <!-- Enlaces Rápidos -->
            <div class="footer-section">
                <h3>Enlaces Rápidos</h3>
                <ul class="footer-links">
                    <li><a href="index.html">Inicio</a></li>
                    <li><a href="canchas.html">Canchas</a></li>
                    <li><a href="reserva.php">Reservar</a></li>
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

            <!-- Información de Contacto -->
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

        <!-- Línea de Copyright -->
        <div class="footer-bottom">
            <p>&copy; 2025 Reservas de Canchas Web. Todos los derechos reservados.</p>
        </div>
    </footer>
    <script src="js/asistente.js"></script>
</body>
</html>
