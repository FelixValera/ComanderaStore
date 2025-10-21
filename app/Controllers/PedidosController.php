<?php
namespace App\Controllers;

use Domain\Repositories\OdespaRepository;
use Domain\Repositories\OaretiRepository;

class PedidosController{

    public static function PendientesBoedo1050($req,$param){
        
        $date = date('Y-m-d'); //fecha actual
        
        $odespas = new OdespaRepository($req->dataSource);
        $oaretis = new OaretiRepository($req->dataSource);
        
        $odespasPendientes = $odespas->getOdespas('0009',$date);
        $oaretisPendientes = $oaretis->getOaretis('0009',$date);
        
        require_once __DIR__ . '/../views/pedidos.php';
    }
}