<?php
    require_once __DIR__ . '/head.html';
?>

<body class="bg-gray-50 min-h-screen flex flex-col items-center p-6">

    <!-- Barra superior -->
    <?php
        require_once __DIR__ . '/nav.html';
    ?>

    <main class="mt-[12vh] px-8">
        
        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-3 gap-8 justify-center">
            <!-- Tarjeta 1-->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition duration-300">

                <!-- Encabezado de la orden -->
                <div class="bg-gray-100 p-5 text-gray-800 border-b border-gray-200">
                <!-- Primera línea: número de orden grande -->
                <div class="flex justify-between items-center mb-2">
                    <p class="font-bold text-2xl text-emerald-600">Odespas #342767</p>
                    <p class="text-xl font-semibold">Hora: 12:10</p>
                </div>

                <!-- Segunda línea: datos distribuidos horizontalmente -->
                <div class="flex flex-wrap justify-between text-lg">
                    <p>Cliente: <span class="font-semibold">SAVAL DIANA</span></p>
                    <p>Factura: <span class="font-semibold text-xl">FB0901-54173</span></p>
                </div>
                </div>

                <!-- Contenedor con scroll -->
                <div class="p-6 max-h-[30rem] overflow-y-auto">
                    <table class="w-full text-base text-left border-collapse">
                        <thead class="sticky top-0 bg-white border-b">
                        <tr class="text-gray-600 uppercase text-sm">
                            <th class="py-4 px-2 w-32">Artículo</th>
                            <th class="py-4 px-2">Descripción</th>
                            <th class="py-4 px-2 text-right">Cantidad</th>
                        </tr>
                        </thead>
                        <tbody class="text-gray-800">
                            <tr class="border-b hover:bg-gray-50">
                                <td class="py-4 px-2 font-mono font-bold text-3xl text-gray-800 text-center">
                                    354975
                                </td>
                                <td class="py-4 px-2 text-lg">ATM MATRB20UBP / MICROONDAS 20LT MEC NEGRO</td>
                                <td class="py-4 px-2 text-right font-semibold text-2xl">10</td>
                            </tr>
                            <tr class="border-b hover:bg-gray-50">
                                <td class="py-4 px-2 font-mono font-bold text-3xl text-gray-800 text-center">
                                353399
                                </td>
                                <td class="py-4 px-2 text-lg">ATM PE1821AP2 BCA / PAVA ELEC 1,7LTS MATE BCA</td>
                                <td class="py-4 px-2 text-right font-semibold text-2xl">1</td>
                            </tr>
                            <tr class="border-b hover:bg-gray-50">
                                <td class="py-4 px-2 font-mono font-bold text-3xl text-gray-800 text-center">
                                141202
                                </td>
                                <td class="py-4 px-2 text-lg">GAM DIFFUSION/PARED / SECADOR DE CABELLO PARED</td>
                                <td class="py-4 px-2 text-right font-semibold text-2xl">1</td>
                            </tr>
                            <tr class="border-b hover:bg-gray-50">
                                <td class="py-4 px-2 font-mono font-bold text-3xl text-gray-800 text-center">
                                141202
                                </td>
                                <td class="py-4 px-2 text-lg">GAM DIFFUSION/PARED / SECADOR DE CABELLO PARED</td>
                                <td class="py-4 px-2 text-right font-semibold text-2xl">1</td>
                            </tr>
                             <tr class="border-b hover:bg-gray-50">
                                <td class="py-4 px-2 font-mono font-bold text-3xl text-gray-800 text-center">
                                141202
                                </td>
                                <td class="py-4 px-2 text-lg">GAM DIFFUSION/PARED / SECADOR DE CABELLO PARED</td>
                                <td class="py-4 px-2 text-right font-semibold text-2xl">1</td>
                            </tr>
                             <tr class="border-b hover:bg-gray-50">
                                <td class="py-4 px-2 font-mono font-bold text-3xl text-gray-800 text-center">
                                141202
                                </td>
                                <td class="py-4 px-2 text-lg">GAM DIFFUSION/PARED / SECADOR DE CABELLO PARED</td>
                                <td class="py-4 px-2 text-right font-semibold text-2xl">1</td>
                            </tr>
                             <tr class="border-b hover:bg-gray-50">
                                <td class="py-4 px-2 font-mono font-bold text-3xl text-gray-800 text-center">
                                141202
                                </td>
                                <td class="py-4 px-2 text-lg">GAM DIFFUSION/PARED / SECADOR DE CABELLO PARED</td>
                                <td class="py-4 px-2 text-right font-semibold text-2xl">1</td>
                            </tr>
                             <tr class="border-b hover:bg-gray-50">
                                <td class="py-4 px-2 font-mono font-bold text-3xl text-gray-800 text-center">
                                141202
                                </td>
                                <td class="py-4 px-2 text-lg">GAM DIFFUSION/PARED / SECADOR DE CABELLO PARED</td>
                                <td class="py-4 px-2 text-right font-semibold text-2xl">1</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>

            <!-- Tarjeta 2-->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition duration-300">

                <!-- Encabezado de la orden -->
                <div class="bg-gray-100 p-5 text-gray-800 border-b border-gray-200">
                <!-- Primera línea: número de orden grande -->
                <div class="flex justify-between items-center mb-2">
                    <p class="font-bold text-2xl text-emerald-600">Odespas #342767</p>
                    <p class="text-xl font-semibold">Hora: 12:10</p>
                </div>

                <!-- Segunda línea: datos distribuidos horizontalmente -->
                <div class="flex flex-wrap justify-between text-lg">
                    <p>Cliente: <span class="font-semibold">SAVAL DIANA</span></p>
                    <p>Factura: <span class="font-semibold text-xl">FB0901-54173</span></p>
                </div>
                </div>

                <!-- Contenedor con scroll -->
                <div class="p-6 max-h-[30rem] overflow-y-auto">
                    <table class="w-full text-base text-left border-collapse">
                        <thead class="sticky top-0 bg-white border-b">
                        <tr class="text-gray-600 uppercase text-sm">
                            <th class="py-4 px-2 w-32">Artículo</th>
                            <th class="py-4 px-2">Descripción</th>
                            <th class="py-4 px-2 text-right">Cantidad</th>
                        </tr>
                        </thead>
                        <tbody class="text-gray-800">
                            <tr class="border-b hover:bg-gray-50">
                                <td class="py-4 px-2 font-mono font-bold text-3xl text-gray-800 text-center">
                                    354975
                                </td>
                                <td class="py-4 px-2 text-lg">ATM MATRB20UBP / MICROONDAS 20LT MEC NEGRO</td>
                                <td class="py-4 px-2 text-right font-semibold text-2xl">10</td>
                            </tr>
                            <tr class="border-b hover:bg-gray-50">
                                <td class="py-4 px-2 font-mono font-bold text-3xl text-gray-800 text-center">
                                353399
                                </td>
                                <td class="py-4 px-2 text-lg">ATM PE1821AP2 BCA / PAVA ELEC 1,7LTS MATE BCA</td>
                                <td class="py-4 px-2 text-right font-semibold text-2xl">1</td>
                            </tr>
                            <tr class="border-b hover:bg-gray-50">
                                <td class="py-4 px-2 font-mono font-bold text-3xl text-gray-800 text-center">
                                141202
                                </td>
                                <td class="py-4 px-2 text-lg">GAM DIFFUSION/PARED / SECADOR DE CABELLO PARED</td>
                                <td class="py-4 px-2 text-right font-semibold text-2xl">1</td>
                            </tr>
                            <tr class="border-b hover:bg-gray-50">
                                <td class="py-4 px-2 font-mono font-bold text-3xl text-gray-800 text-center">
                                141202
                                </td>
                                <td class="py-4 px-2 text-lg">GAM DIFFUSION/PARED / SECADOR DE CABELLO PARED</td>
                                <td class="py-4 px-2 text-right font-semibold text-2xl">1</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>

            <!-- Tarjeta 3-->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition duration-300">

                <!-- Encabezado de la orden -->
                <div class="bg-gray-100 p-5 text-gray-800 border-b border-gray-200">
                <!-- Primera línea: número de orden grande -->
                <div class="flex justify-between items-center mb-2">
                    <p class="font-bold text-2xl text-emerald-600">Odespas #342767</p>
                    <p class="text-xl font-semibold">Hora: 12:10</p>
                </div>

                <!-- Segunda línea: datos distribuidos horizontalmente -->
                <div class="flex flex-wrap justify-between text-lg">
                    <p>Cliente: <span class="font-semibold">SAVAL DIANA</span></p>
                    <p>Factura: <span class="font-semibold text-xl">FB0901-54173</span></p>
                </div>
                </div>

                <!-- Contenedor con scroll -->
                <div class="p-6 max-h-[30rem] overflow-y-auto">
                    <table class="w-full text-base text-left border-collapse">
                        <thead class="sticky top-0 bg-white border-b">
                        <tr class="text-gray-600 uppercase text-sm">
                            <th class="py-4 px-2 w-32">Artículo</th>
                            <th class="py-4 px-2">Descripción</th>
                            <th class="py-4 px-2 text-right">Cantidad</th>
                        </tr>
                        </thead>
                        <tbody class="text-gray-800">
                            <tr class="border-b hover:bg-gray-50">
                                <td class="py-4 px-2 font-mono font-bold text-3xl text-gray-800 text-center">
                                    354975
                                </td>
                                <td class="py-4 px-2 text-lg">ATM MATRB20UBP / MICROONDAS 20LT MEC NEGRO</td>
                                <td class="py-4 px-2 text-right font-semibold text-2xl">10</td>
                            </tr>
                            <tr class="border-b hover:bg-gray-50">
                                <td class="py-4 px-2 font-mono font-bold text-3xl text-gray-800 text-center">
                                353399
                                </td>
                                <td class="py-4 px-2 text-lg">ATM PE1821AP2 BCA / PAVA ELEC 1,7LTS MATE BCA</td>
                                <td class="py-4 px-2 text-right font-semibold text-2xl">1</td>
                            </tr>
                            <tr class="border-b hover:bg-gray-50">
                                <td class="py-4 px-2 font-mono font-bold text-3xl text-gray-800 text-center">
                                141202
                                </td>
                                <td class="py-4 px-2 text-lg">GAM DIFFUSION/PARED / SECADOR DE CABELLO PARED</td>
                                <td class="py-4 px-2 text-right font-semibold text-2xl">1</td>
                            </tr>
                            <tr class="border-b hover:bg-gray-50">
                                <td class="py-4 px-2 font-mono font-bold text-3xl text-gray-800 text-center">
                                141202
                                </td>
                                <td class="py-4 px-2 text-lg">GAM DIFFUSION/PARED / SECADOR DE CABELLO PARED</td>
                                <td class="py-4 px-2 text-right font-semibold text-2xl">1</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    
    </main>
</body>
</html>



<!--

    🧩 Sugerencias para mejorarlo en pantallas grandes

    Podés agregar tres pequeños ajustes:

    1️⃣ Limitar el ancho máximo del contenido central

    Para que las tarjetas no se expandan demasiado en TVs 4K:

    <main class="mt-[12vh] px-8 max-w-[95vw] mx-auto">


    → Evita que las tarjetas queden muy separadas o pegadas a los bordes.

    2️⃣ Dar un ancho mínimo a las tarjetas

    Así evitás que las columnas se aplasten en pantallas medianas:

    <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition duration-300 min-w-[420px]">

    3️⃣ Añadir un pequeño margen inferior al grid

    Por ejemplo:

    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-3 gap-8 justify-center mb-[5vh]">


    → Evita que las tarjetas queden “pegadas” al borde inferior del TV.

-->