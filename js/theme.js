// Función para obtener el tema preferido del sistema
function getSystemTheme() {
  return window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
}

// Función para aplicar el tema
function applyTheme(theme) {
  if (theme === 'dark') {
    document.body.setAttribute('data-theme', 'dark');
  } else {
    document.body.removeAttribute('data-theme');
  }
  localStorage.setItem('theme', theme);
}

function initTheme() {
  const savedTheme = localStorage.getItem('theme') || getSystemTheme();
  applyTheme(savedTheme);
}

function toggleTheme() {
  const currentTheme = document.body.hasAttribute('data-theme') ? 'dark' : 'light';
  const newTheme = currentTheme === 'light' ? 'dark' : 'light';
  applyTheme(newTheme);
}


document.addEventListener('DOMContentLoaded', function() {
  initTheme();
  const themeToggle = document.getElementById('themeToggle');
  if (themeToggle) {
    themeToggle.addEventListener('click', toggleTheme);
  }
});

window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', function(e) {
  if (!localStorage.getItem('theme')) {
    applyTheme(e.matches ? 'dark' : 'light');
  }
});

  // Detectar errores desde URL
  const urlParams = new URLSearchParams(window.location.search);
  const error = urlParams.get('error');

  if (error === 'password') {
    document.getElementById('password').classList.add('error');
    document.getElementById('passwordError').classList.add('show');
  } else if (error === 'user') {
    document.getElementById('email').classList.add('error');
    document.getElementById('emailError').classList.add('show');
  }

  // Limpiar errores al escribir
  document.getElementById('email').addEventListener('input', function() {
    this.classList.remove('error');
    document.getElementById('emailError').classList.remove('show');
  });

  document.getElementById('password').addEventListener('input', function() {
    this.classList.remove('error');
    document.getElementById('passwordError').classList.remove('show');
  });
