<?php
require_once __DIR__ . '/head.html';
?>

<body class="bg-gray-50 min-h-screen flex flex-col items-center justify-center p-6">

    <!-- Barra superior -->
    <nav class="bg-white shadow-md fixed top-0 left-0 w-full z-10">
        <div class="container mx-auto flex items-center justify-between p-4">
        <!-- Logo -->
        <div class="flex items-center space-x-3">
            <img src="<?php echo $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . '/ComanderaStore/public/img/logo-small.png'; ?>" alt="Logo" class="w-24 h-12 object-contain">
            <span class="text-xl font-bold text-gray-700">Comandera Store</span>
        </div>
        </div>
    </nav>

    <h1 class="text-2xl font-bold mb-8 text-gray-800">Órdenes Pendientes</h1>

    <div class="container mx-auto grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-8">
        <!-- Tarjeta -->
        <div class="bg-white rounded-2xl shadow-md overflow-hidden hover:shadow-lg transition">
            <div class="bg-gray-100 h-40 flex items-center justify-center text-gray-400 text-2xl">
                420 × 260
            </div>
            <div class="p-4">
                <p class="text-xs text-gray-500 uppercase tracking-wide mb-1">Orden #001</p>
                <h2 class="text-lg font-semibold text-gray-800 mb-1">Cliente: Juan Pérez</h2>
                <p class="text-sm text-gray-500 mb-2">3 ítems pendientes</p>
                <p class="text-sm font-semibold text-green-600">$124.00</p>
            </div>
        </div>

        <!-- Copiá o generá dinámicamente más tarjetas -->
        <div class="bg-white rounded-2xl shadow-md overflow-hidden hover:shadow-lg transition">
            <div class="bg-gray-100 h-40 flex items-center justify-center text-gray-400 text-2xl">
                421 × 261
            </div>
            <div class="p-4">
                <p class="text-xs text-gray-500 uppercase tracking-wide mb-1">Orden #002</p>
                <h2 class="text-lg font-semibold text-gray-800 mb-1">Cliente: María López</h2>
                <p class="text-sm text-gray-500 mb-2">1 ítem pendiente</p>
                <p class="text-sm font-semibold text-green-600">$82.50</p>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-md overflow-hidden hover:shadow-lg transition">
            <div class="bg-gray-100 h-40 flex items-center justify-center text-gray-400 text-2xl">
                422 × 262
            </div>
            <div class="p-4">
                <p class="text-xs text-gray-500 uppercase tracking-wide mb-1">Orden #003</p>
                <h2 class="text-lg font-semibold text-gray-800 mb-1">Cliente: Pedro García</h2>
                <p class="text-sm text-gray-500 mb-2">2 ítems pendientes</p>
                <p class="text-sm font-semibold text-green-600">$64.00</p>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-md overflow-hidden hover:shadow-lg transition">
            <div class="bg-gray-100 h-40 flex items-center justify-center text-gray-400 text-2xl">
                423 × 263
            </div>
            <div class="p-4">
                <p class="text-xs text-gray-500 uppercase tracking-wide mb-1">Orden #004</p>
                <h2 class="text-lg font-semibold text-gray-800 mb-1">Cliente: Ana Torres</h2>
                <p class="text-sm text-gray-500 mb-2">5 ítems pendientes</p>
                <p class="text-sm font-semibold text-green-600">$210.90</p>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-md overflow-hidden hover:shadow-lg transition">
            <div class="bg-gray-100 h-40 flex items-center justify-center text-gray-400 text-2xl">
                423 × 263
            </div>
            <div class="p-4">
                <p class="text-xs text-gray-500 uppercase tracking-wide mb-1">Orden #004</p>
                <h2 class="text-lg font-semibold text-gray-800 mb-1">Cliente: Ana Torres</h2>
                <p class="text-sm text-gray-500 mb-2">5 ítems pendientes</p>
                <p class="text-sm font-semibold text-green-600">$210.90</p>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-md overflow-hidden hover:shadow-lg transition">
            <div class="bg-gray-100 h-40 flex items-center justify-center text-gray-400 text-2xl">
                423 × 263
            </div>
            <div class="p-4">
                <p class="text-xs text-gray-500 uppercase tracking-wide mb-1">Orden #004</p>
                <h2 class="text-lg font-semibold text-gray-800 mb-1">Cliente: Ana Torres</h2>
                <p class="text-sm text-gray-500 mb-2">5 ítems pendientes</p>
                <p class="text-sm font-semibold text-green-600">$210.90</p>
            </div>
        </div>
    </div>

</body>

</html>