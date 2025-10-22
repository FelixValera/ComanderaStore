<?php
    require_once __DIR__ . '/head.html';
?>

<body class="bg-gray-50 min-h-screen flex flex-col items-center p-6">

    <!-- Barra superior -->
    <?php
        require_once __DIR__ . '/nav.html';

        //Seteamos la fecha ultima_actualizacion
        $_SESSION['ultima_actualizacion'] = date('Y-m-d H:i:s.v');
    ?>

    <main class="mt-[12vh] px-8">
        <?php if(!empty($odespasPendientes) || !empty($oaretisPendientes)):?>

            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-3 gap-8 justify-center">
                <!-- Tarjetas Odespas -->
                <?php if(!empty($odespasPendientes)): ?>
                    
                    <?php foreach ($odespasPendientes as $odespa): ?>

                        <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition duration-300">

                            <!-- Encabezado de la orden -->
                            <div class="<?php echo ($odespa->getDelay() >= 20) ? 'bg-red-200' :( ($odespa->getDelay() >= 10) ? 'bg-yellow-100' : 'bg-gray-100')?> p-5 text-gray-800 border-b border-gray-200">
                                <!-- Primera línea: número de orden grande -->
                                <div class="flex justify-between items-center mb-2">
                                    <p class="font-bold text-2xl text-emerald-600">ODESPA #<?= $odespa->nrofor?></p>
                                    <p class="text-xl font-semibold">Hora: <?=$odespa->hora?></p>
                                </div>

                                <!-- Segunda línea: datos distribuidos horizontalmente -->
                                <div class="flex flex-wrap justify-between text-lg">
                                    <p>Cliente: <span class="font-semibold"><?=$odespa->nombre?></span></p>
                                    <p>Factura: <span class="font-semibold text-xl"><?=$odespa->codfac.'-'.$odespa->nrofac?></span></p>
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
                                        <?php foreach ($odespa->items as $item): ?>
                                            <tr class="border-b hover:bg-gray-50">
                                                <td class="py-4 px-2 text-xl text-gray-800 text-center">
                                                    <?= $item->articulo ?>
                                                </td>
                                                <td class="py-4 px-2 text-xl font-mono font-semibold"><?= $item->descripcion ?></td>
                                                <td class="py-4 px-2 text-right text-xl"><?= $item->getPendientes() ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>

                        </div>

                    <?php endforeach; ?>

                <?php endif ?>    

                <?php if(!empty($oaretisPendientes)): ?>

                    <?php foreach ($oaretisPendientes as $oareti): ?>

                        <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition duration-300">

                            <!-- Encabezado de la orden -->
                            <div class="<?php echo ($oareti->getDelay() >= 20) ? 'bg-red-200' :( ($oareti->getDelay() >= 10) ? 'bg-yellow-100' : 'bg-gray-100')?> p-5 text-gray-800 border-b border-gray-200">
                                <!-- Primera línea: número de orden grande -->
                                <div class="flex justify-between items-center mb-2">
                                    <p class="font-bold text-2xl text-indigo-700">OARETI #<?= $oareti->nrofor?></p>
                                    <p class="text-xl font-semibold">Hora: <?=$oareti->hora?></p>
                                </div>

                                <!-- Segunda línea: datos distribuidos horizontalmente -->
                                <div class="flex flex-wrap justify-between text-lg">
                                    <p>Cliente: <span class="font-semibold"><?=$oareti->nombre?></span></p>
                                    <p>Factura: <span class="font-semibold text-xl"><?=$oareti->codfac.'-'.$oareti->nrofac?></span></p>
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
                                        <?php foreach ($oareti->items as $item): ?>
                                            <tr class="border-b hover:bg-gray-50">
                                                <td class="py-4 px-2 text-xl text-gray-800 text-center">
                                                    <?= $item->articulo ?>
                                                </td>
                                                <td class="py-4 px-2 text-xl font-mono font-semibold"><?= $item->descripcion ?></td>
                                                <td class="py-4 px-2 text-right text-xl"><?= $item->getPendientes() ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>

                        </div>

                    <?php endforeach; ?>
                
                <?php endif ?>

            </div>

        <?php else: ?> 

            <!-- Si no hay Ordenes  -->
            <div class="flex flex-col items-center justify-center h-[70vh] text-center text-gray-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-24 h-24 mb-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m2 0a2 2 0 012 2v5H5v-5a2 2 0 012-2h10zm-7-8h4a2 2 0 012 2v4H8V7a2 2 0 012-2z" />
                </svg>

                <p class="text-3xl font-semibold text-gray-500">No hay órdenes pendientes</p>
                <p class="text-lg text-gray-400 mt-2">Cuando se genere una nueva orden, aparecerá aquí.</p>
            </div>

        <?php endif ?>
    
    </main>
    
    <script src="<?php echo $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . '/ComanderaStore/public/js/script.js'; ?>"></script>

    <!-- notificamos si hay ordenes nuevas -->

    <?php if($nuevasOdespas || $nuevasOaretis): ?>
        <script>

            if (Notification.permission === "granted") {

                console.log('me estoy ejecutando');

                new Notification("Nueva orden disponible 🧾");

            }else if (Notification.permission !== "denied") {

                Notification.requestPermission().then(permission => {
                    if (permission === "granted") {
                    new Notification("Notificaciones activadas ✅");
                    }
                });
            }
        
        </script>
    <?php endif ?>

</body>
</html>