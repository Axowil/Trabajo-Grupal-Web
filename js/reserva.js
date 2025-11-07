const TARIFAS = {
    "El Coloso Club V.C.": 120,
    "FRANCISCO'S CLUB": 80,
    "Canchas Sinteticas El Nacional de la Dolores": 90,
    "JARAWA SPORT S.A.C.": 150,
    "Canchas sintéticas Arequipa - Club Las Pampas": 60,
    "El Clásico - Cancha Sintética": 95,
    "Olympus Tennis Camps": 95,
    "Canchas sintéticas EL GOLAZO": 95,
    'Cancha Sintética "San Siro"': 100
  };

  document.addEventListener("DOMContentLoaded", () => {
    const parametrosURL = new URLSearchParams(window.location.search);
    const canchaDesdeURL = parametrosURL.get("cancha");
    const selectCancha = document.getElementById("cancha");
    if (canchaDesdeURL && selectCancha) {
      const opcionEncontrada = [...selectCancha.options].find(opcion =>
        opcion.value.trim().toLowerCase() === canchaDesdeURL.trim().toLowerCase()
        || opcion.textContent.trim().toLowerCase() === canchaDesdeURL.trim().toLowerCase()
      );
      if (opcionEncontrada) opcionEncontrada.selected = true;
    }
    actualizarTarifa();
  });

  function actualizarTarifa() {
    const cancha = document.getElementById("cancha").value || "";
    document.getElementById("tarifaHora").value = cancha ? (TARIFAS[cancha] ?? "") : "";
    document.getElementById("horasTotales").value = "";
    document.getElementById("totalPagar").value = "";
    document.getElementById("estadoDisponibilidad").textContent = "";
    document.getElementById("estadoDisponibilidad").className = "estado";
  }
  document.getElementById("cancha").addEventListener("change", actualizarTarifa);

  // Utilidades de tiempo
  function minutos(hhmm) {
    const [h, m] = (hhmm || "").split(":").map(Number);
    return h * 60 + m;
  }
  function horasEntre(inicioStr, finStr) {
    if (!inicioStr || !finStr) 
      return null;
    let ini = minutos(inicioStr);
    let fin = minutos(finStr);
    if (fin <= ini) 
      fin += 24 * 60;
    return (fin - ini) / 60;
  }

  // Calcular costo
  document.getElementById("btnCalcular").addEventListener("click", () => {
    const tarifa = parseFloat(document.getElementById("tarifaHora").value || "0");
    const ini = document.getElementById("horaInicio").value;
    const fin = document.getElementById("horaFin").value;

    if (!document.getElementById("cancha").value) 
      return alert("Selecciona la cancha.");
    if (!document.getElementById("fecha").value) 
      return alert("Selecciona la fecha.");
    if (!ini || !fin) 
      return alert("Completa las horas.");

    const horas = horasEntre(ini, fin);
    if (!horas || horas <= 0) 
      return alert("La hora de fin debe ser mayor a la de inicio (se admite cruce de medianoche).");
    document.getElementById("horasTotales").value = horas.toFixed(2);
    document.getElementById("totalPagar").value = (horas * (tarifa || 0)).toFixed(2);
  });

  // 3) Disponibilidad simulada local (por día/cancha/horario)
  function sobrePuesto(a1, a2, b1, b2) {
    return (minutos(a1) < minutos(b2)) && (minutos(a2) > minutos(b1));
  }
  function keyReserva(cancha, fecha) {
    return `RESERVAS_${cancha}_${fecha}`;
  }

  document.getElementById("btnDisponibilidad").addEventListener("click", () => {
    const cancha = document.getElementById("cancha").value;
    const fecha = document.getElementById("fecha").value;
    const ini = document.getElementById("horaInicio").value;
    const fin = document.getElementById("horaFin").value;

    const estado = document.getElementById("estadoDisponibilidad");
    if (!cancha || !fecha || !ini || !fin) {
      estado.textContent = "Completa cancha, fecha y horas.";
      estado.className = "estado no";
      return;
    }

    if (!(minutos("07:00") <= minutos(ini) && (minutos(fin) > minutos(ini) ? minutos(fin) : minutos(fin)+1440) <= minutos("23:00")+1440)) {
      estado.textContent = "No disponible: fuera del horario (07:00–23:00).";
      estado.className = "estado no";
      return;
    }

    const key = keyReserva(cancha, fecha);
    const prev = JSON.parse(localStorage.getItem(key) || "[]");
    const choca = prev.some(b => sobrePuesto(ini, fin, b.ini, b.fin));

    if (choca) {
      estado.textContent = "No disponible.";
      estado.className = "estado no";
    } else {
      estado.textContent = "Disponible.";
      estado.className = "estado si";
    }
  });

  // Registrar en localStorage al confirmar
  document.getElementById("formReserva").addEventListener("submit", (event) => {
    event.preventDefault();
    const cancha = document.getElementById("cancha").value;
    const fecha = document.getElementById("fecha").value;
    const ini = document.getElementById("horaInicio").value;
    const fin = document.getElementById("horaFin").value;

    if (!cancha || !fecha || !ini || !fin) return alert("Completa todos los campos.");
    const key = keyReserva(cancha, fecha);
    const reservasPrev = JSON.parse(localStorage.getItem(key) || "[]");

    // Verificar solape antes de guardar
    if (reservasPrev.some(reservaExistente => sobrePuesto(ini, fin, reservaExistente.ini, reservaExistente.fin))) {
      alert("Ese rango no está disponible.");
      return;
    }

    reservasPrev.push({ ini, fin });
    localStorage.setItem(key, JSON.stringify(reservasPrev));
    alert("Reserva registrada correctamente.");
  });