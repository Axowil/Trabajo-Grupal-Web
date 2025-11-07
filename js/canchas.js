function filtrarCanchas() {
            const ubicacion = document.getElementById('ubicacion').value;
            const superficie = document.getElementById('superficie').value;
            const precio = document.getElementById('precio').value;
            const cards = document.querySelectorAll('.cancha-card');
            let hayResultados = false;

            cards.forEach(card => {
                let mostrar = true;

                if (ubicacion && card.getAttribute('data-ubicacion') !== ubicacion) {
                    mostrar = false;
                }

                if (superficie && card.getAttribute('data-superficie') !== superficie) {
                    mostrar = false;
                }

                if (precio) {
                    const precioCard = parseInt(card.getAttribute('data-precio'));
                    if (precio === '0-50' && (precioCard < 0 || precioCard > 50)) mostrar = false;
                    if (precio === '50-100' && (precioCard < 50 || precioCard > 100)) mostrar = false;
                    if (precio === '100-150' && (precioCard < 100 || precioCard > 150)) mostrar = false;
                    if (precio === '150' && precioCard < 150) mostrar = false;
                }

                if (mostrar) {
                    card.style.display = 'block';
                    hayResultados = true;
                } else {
                    card.style.display = 'none';
                }
            });

            document.getElementById('mensajeVacio').style.display = hayResultados ? 'none' : 'block';
        }

        function limpiarFiltros() {
            document.getElementById('ubicacion').value = '';
            document.getElementById('superficie').value = '';
            document.getElementById('precio').value = '';
            document.querySelectorAll('.cancha-card').forEach(card => {
                card.style.display = 'block';
            });
            document.getElementById('mensajeVacio').style.display = 'none';
        }