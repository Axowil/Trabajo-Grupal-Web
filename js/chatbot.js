document.addEventListener("DOMContentLoaded", () => {
    const fab = document.getElementById("chatbotFab");
    const panel = document.getElementById("chatbotPanel");
    const closeBtn = document.getElementById("chatbotClose");
    const minBtn = document.getElementById("chatbotMin");

    const msgs = document.getElementById("chatbotMsgs");
    const form = document.getElementById("chatbotForm");
    const input = document.getElementById("chatbotText");
    const chips = document.querySelectorAll(".chatbot-chip");

    const KEY = "rk_chat_canchas_v1";
    let history = loadHistory();

    // =================== MODELO KEYS + MSG ===================
    const respuestas = [
    {
        keys: ["hola", "buenas", "hey", "saludos", "holi"],
        msg: [
        "¡Hola! ⚽ Puedes escribir: <b>canchas</b>, <b>reservar</b>, <b>precios</b> o <b>contacto</b>."
        ]
    },

    {
        keys: ["canchas", "cancha", "disponibles", "lugares", "instalaciones"],
        msg: [
        "Puedes ver las canchas disponibles en <a href='canchas.html'>Canchas</a>.",
        "Escribe el nombre de una cancha: <b>Coloso</b>, <b>Francisco</b>, <b>San Siro</b> o <b>Jarawa</b>."
        ]
    },

    {
        keys: ["reservar", "reserva", "agendar", "separar", "apartar"],
        msg: [
        "Para reservar entra a <a href='reserva.html'>Reservar</a> y completa el formulario.",
        "La reserva se realiza desde <a href='reserva.html'>Reservar</a>."
        ]
    },

    {
        keys: ["horarios", "horario"],
        msg: [
        "Los horarios se eligen directamente al momento de reservar.",
        "Para ver horarios disponibles, entra a <a href='reserva.html'>Reservar</a>."
        ]
    },

    {
        keys: ["precio", "precios", "costo", "tarifa"],
        msg: [
        "Los precios dependen de la cancha seleccionada.",
        "Consulta los precios al elegir una cancha en <a href='canchas.html'>Canchas</a>."
        ]
    },

    {
        keys: ["contacto", "telefono", "correo", "email"],
        msg: [
        "Contacto: ✉️ contacto@reservewebstadium.com | 📞 +51 987 654 321",
        "También puedes escribirnos desde <a href='contactanos.html'>Contacto</a>."
        ]
    },

    {
        keys: ["coloso"],
        msg: [
        "El Coloso Club V.C. ⚽ Puedes reservarlo desde <a href='reserva.html'>Reservar</a>."
        ]
    },

    {
        keys: ["francisco", "francisco's", "franciscos"],
        msg: [
        "FRANCISCO'S CLUB ⚽ Disponible para reservar en <a href='reserva.html'>Reservar</a>."
        ]
    },

    {
        keys: ["san siro", "siro"],
        msg: [
        "Cancha Sintética San Siro ⚽ Puedes reservarla en <a href='reserva.html'>Reservar</a>."
        ]
    },

    {
        keys: ["jarawa", "jarawa sport"],
        msg: [
        "JARAWA SPORT S.A.C. ⚽ Reserva disponible en <a href='reserva.html'>Reservar</a>."
        ]
    },

    {
        keys: ["sobre nosotros", "nosotros"],
        msg: [
        "Conoce más en <a href='sobreNosotros.html'>Sobre Nosotros</a>."
        ]
    },

    {
        keys: ["ayuda", "comandos", "opciones"],
        msg: [
        "Opciones disponibles: <b>canchas</b>, <b>reservar</b>, <b>precios</b>, <b>contacto</b>."
        ]
    },

    {
        keys: ["borrar historial", "limpiar", "reset", "clear"],
        msg: "__CLEAR__"
    }
    ];

  // =================== HELPERS ===================
  function norm(s) {
    return (s || "")
      .toLowerCase()
      .normalize("NFD").replace(/[\u0300-\u036f]/g, "")
      .replace(/[^\w\s:\/.-]/g, " ")
      .replace(/\s+/g, " ")
      .trim();
  }

  function pickMsg(m) {
    return Array.isArray(m) ? m[Math.floor(Math.random() * m.length)] : m;
  }

  function scoreText(t, keys) {
    let score = 0;
    for (const raw of keys) {
      const k = norm(raw);
      if (!k) continue;

      if (k.includes(" ")) {
        if (t.includes(k)) score += 3;       // frase pesa más
      } else {
        const re = new RegExp(`\\b${k}\\b`, "g");
        score += (t.match(re) || []).length; // palabra completa
      }
    }
    return score;
  }

  function responder(text) {
    const t = norm(text);
    if (!t) return "Escribe algo y te respondo 🙂";

    let best = null;
    let bestScore = 0;

    for (const r of respuestas) {
      const sc = scoreText(t, r.keys);
      if (sc > bestScore) {
        bestScore = sc;
        best = r;
      }
    }

    if (!best || bestScore === 0) {
      return `No te entendí 😅. Prueba con:
      <div style="margin-top:8px; display:flex; flex-wrap:wrap; gap:8px;">
        <button class="chatbot-qbtn" data-q="canchas" type="button">Canchas</button>
        <button class="chatbot-qbtn" data-q="reservar" type="button">Reservar</button>
        <button class="chatbot-qbtn" data-q="precios" type="button">Precios</button>
        <button class="chatbot-qbtn" data-q="contacto" type="button">Contacto</button>
      </div>`;
    }

    const out = pickMsg(best.msg);
    return out;
  }

  // =================== HISTORIAL ===================
  function loadHistory() {
    try { return JSON.parse(localStorage.getItem(KEY)) || []; }
    catch { return []; }
  }
  function saveHistory() {
    localStorage.setItem(KEY, JSON.stringify(history));
  }

  // =================== UI CHAT ===================
  function addMsg(role, html) {
    const wrap = document.createElement("div");
    wrap.className = "chatbot-msg " + role;

    const bubble = document.createElement("div");
    bubble.className = "chatbot-bubble";
    bubble.innerHTML = html; // permitimos links/buttons controlados por nosotros

    wrap.appendChild(bubble);
    msgs.appendChild(wrap);
    msgs.scrollTop = msgs.scrollHeight;
  }

  function renderHistory() {
    msgs.innerHTML = "";
    if (history.length === 0) {
      addMsg("bot", "Hola 🙂 Soy tu asistente de reservas. Escribe <b>canchas</b> o <b>reservar</b>.");
      return;
    }
    history.forEach(m => addMsg(m.role, m.html));
  }

  function sendText(text) {
    const t = (text || "").trim();
    if (!t) return;

    addMsg("user", escapeHtml(t));
    history.push({ role: "user", html: escapeHtml(t) });

    const reply = responder(t);

    if (reply === "__CLEAR__") {
      history = [];
      saveHistory();
      msgs.innerHTML = "";
      addMsg("bot", "Listo, historial borrado.");
      return;
    }

    addMsg("bot", reply);
    history.push({ role: "bot", html: reply });

    saveHistory();
  }

  // Evita que el usuario meta HTML (solo el bot puede)
  function escapeHtml(str) {
    return str
      .replaceAll("&", "&amp;")
      .replaceAll("<", "&lt;")
      .replaceAll(">", "&gt;")
      .replaceAll('"', "&quot;")
      .replaceAll("'", "&#039;");
  }

  // =================== OPEN/CLOSE ===================
  function openChat() {
    panel.style.display = "block";
    panel.setAttribute("aria-hidden", "false");
    input.focus();
  }
  function closeChat() {
    panel.style.display = "none";
    panel.setAttribute("aria-hidden", "true");
  }

  fab.addEventListener("click", () => {
    if (panel.style.display === "block") closeChat();
    else openChat();
  });

  closeBtn.addEventListener("click", closeChat);
  minBtn.addEventListener("click", closeChat);

  // =================== EVENTS ===================
  form.addEventListener("submit", (e) => {
    e.preventDefault();
    sendText(input.value);
    input.value = "";
    input.focus();
  });

  chips.forEach(btn => {
    btn.addEventListener("click", () => {
      sendText(btn.dataset.q || "");
    });
  });

  // Delegación: botones dinámicos del fallback (chatbot-qbtn)
  msgs.addEventListener("click", (e) => {
    const b = e.target.closest(".chatbot-qbtn");
    if (!b) return;
    sendText(b.getAttribute("data-q"));
  });

  // cargar historial
  renderHistory();
});
