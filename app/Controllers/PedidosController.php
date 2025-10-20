<?php
namespace App\Controllers;

use Domain\Repositories\OdespaRepository;
use Domain\Repositories\OaretiRepository;

class PedidosController{

    public static function PendientesBoedo1050($req,$param){
        /*
        $odespas = new OdespaRepository($req->dataSource);
        $oaretis = new OaretiRepository($req->dataSource);

        $odespasPendientes = $odespas->getOdespas('0009','2025-10-16');

        $oaretisPendientes = $oaretis->getOaretis('0009','2025-10-16');*/
        
        require_once __DIR__ . '/../views/pendientes.php';

    }
}