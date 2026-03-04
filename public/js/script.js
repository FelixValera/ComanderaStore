//URL a la que se redirige
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


//---------Registramos las ordenes tomadas --------------------

document.querySelectorAll('.tomar-orden').forEach(btn => {

    btn.addEventListener('click', async () => {

        const codfor = btn.dataset.codfor;
        const nrofor = btn.dataset.nrofor;
        const deposi = btn.dataset.deposi;

        //validamos si la orden fue tomada antes 
        const res = await fetch(`/ComanderaStore/api/ordenes_tomadas/${deposi}`,{
            method: 'GET',
            headers: { 'Content-Type': 'application/json' }
        });

        const tomadas = await res.json();

        const ordenesTomadas = Array.isArray(tomadas) ? tomadas : Object.values(tomadas || {});
        
        const encontrada = ordenesTomadas.some(o =>

            o.codfor === codfor &&
            o.nrofor == nrofor &&
            o.deposi === deposi
        );

        if (encontrada) {
            
            mostrarToast("Esta orden ya fue tomada. Recargando...","error");
            
            btn.disabled = true;
            btn.textContent = "Sincronizando...";
            btn.classList.remove('bg-emerald-500', 'hover:bg-emerald-600', 'text-white');
            btn.classList.add(
                'bg-sky-500',       // Botón gris medio
                'text-white',
                'cursor-not-allowed',
                'opacity-70',
                'hover:bg-gray-500',  // Quita el efecto hover
                'animate-pulse'
            );

            // 3. Refrescar tras un breve delay
            
            setTimeout(() => {
               refrescarPagina();
            }, 3000);

            return;
        }
        else {

            // 1. Enviamos la orden al servidor para marcarla como tomada
            const res = await fetch('/ComanderaStore/api/tomar_orden', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ codfor, nrofor, deposi })
            });

            const data = await res.json();
        
            if (data.ok){

                // Cambiar color de fondo de la tarjeta
                const card = btn.closest('div.bg-white');
                card.classList.remove('bg-white');
                card.classList.add(
                    'bg-sky-100',       // Fondo gris claro
                    'border', 
                    'border-sky-300',   // Borde gris tenue
                    'shadow-inner'       // Efecto suave de sombra interior
                );

                // Desactivar botón y cambiar estilo
                btn.disabled = true;
                btn.textContent = 'En preparación...';

                // Agregar clases de "deshabilitado"
                btn.classList.remove('bg-emerald-500', 'hover:bg-emerald-600', 'text-white');
                btn.classList.add(
                    'bg-sky-500',       // Botón gris medio
                    'text-white',
                    'cursor-not-allowed',
                    'opacity-70',
                    'hover:bg-gray-500'  // Quita el efecto hover
                );
            }
            else{
                console.log(data);
            }
        }
    });
});


//---------Obtenemos las ordenes tomadas y aplicamos estilo en cada refresh --------------------

document.addEventListener('DOMContentLoaded', async () => {

    try {
        // 1. Consultar órdenes tomadas al backend
        const deposito = document.getElementById('deposito').value;

        const res = await fetch(`/ComanderaStore/api/ordenes_tomadas/${deposito}`,{
            method: 'GET',
            headers: { 'Content-Type': 'application/json' }
        });

        const ordenesTomadas = await res.json();
        
        // 2. Recorrer los botones de tomar orden
        document.querySelectorAll('.tomar-orden').forEach(btn => {
            const codfor = btn.dataset.codfor;
            const nrofor = btn.dataset.nrofor;
            const deposi = btn.dataset.deposi;

            // 3. Verificar si esta orden está en la lista de órdenes tomadas
            const encontrada = ordenesTomadas.some(o =>
                o.codfor === codfor &&
                o.nrofor == nrofor &&
                o.deposi === deposi
            );

            // 4. Si está tomada, aplicar los estilos
            if (encontrada) {
                const card = btn.closest('div.bg-white');
                if (card) {
                    card.classList.remove('bg-white');
                    card.classList.add(
                        'bg-sky-100',
                        'border',
                        'border-sky-300',
                        'shadow-inner'
                    );
                }

                btn.disabled = true;
                btn.textContent = 'En preparación...';
                btn.classList.remove('bg-emerald-500', 'hover:bg-emerald-600', 'text-white');
                btn.classList.add(
                    'bg-sky-500',
                    'text-white',
                    'cursor-not-allowed',
                    'opacity-70',
                    'hover:bg-gray-500'
                );
            }
        });

    } catch (err) {
        console.error('Error ordenes tomadas:', err);
    }

});


//---------Mensaje tipo Toast --------------------

function mostrarToast(mensaje, tipo = 'error') {
    // Crear el contenedor del Toast
    const toast = document.createElement('div');
    
    // Definir colores según el tipo
    const bgColor = tipo === 'error' ? 'bg-red-600' : 'bg-amber-600';

    // Clases de Tailwind para posicionamiento, diseño y animación
    toast.className = `fixed top-10 left-1/2 -translate-x-1/2 z-[100] 
                       ${bgColor} text-white px-6 py-3 rounded-lg shadow-xl 
                       flex items-center space-x-2 whitespace-nowrap`;
    
    // Contenido con un icono simple
    toast.innerHTML = `
        <span>${tipo === 'error' ? '⚠️' : '🚫'}</span>
        <span>${mensaje}</span>
    `;

    document.body.appendChild(toast);
}