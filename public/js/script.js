// URL a la que se redirige
const urlActual = window.location.href;

// Intervalo en milisegundos (por ejemplo, 1 minuto = 60000 ms)
const intervalo = 30000;

// Función que redirige a la URI
function refrescarPagina() {
window.location.href = urlActual;
}

// Ejecuta la función cada cierto tiempo
setInterval(refrescarPagina, intervalo);


function updateClock() {

    const now = new Date();
    const hours = now.getHours().toString().padStart(2, '0');
    const minutes = now.getMinutes().toString().padStart(2, '0');
    const seconds = now.getSeconds().toString().padStart(2, '0');
    document.getElementById('clock').textContent = `${hours}:${minutes}:${seconds}`;
}

// Actualizar cada segundo
setInterval(updateClock, 1000);
// Mostrar inmediatamente al cargar
updateClock();