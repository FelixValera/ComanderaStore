<?php
namespace App\Controllers;

use Domain\Repositories\OdespaRepository;
use Domain\Repositories\OaretiRepository;

class PedidosController{

    public static function PendientesBoedo1050($req,$param){
        
        $date = date('Y-m-d'); //fecha actual
        //$date = '2025-10-16';  //fecha de test
        
        $odespas = new OdespaRepository($req->dataSource);
        $oaretis = new OaretiRepository($req->dataSource);
        
        $odespasPendientes = $odespas->getOdespas('0009',$date);
        $oaretisPendientes = $oaretis->getOaretis('0009',$date);
        
        $nuevasOdespas = $odespas->getNuevas('0009',$_SESSION['ultima_actualizacion']);
        $nuevasOaretis = $oaretis->getNuevas('0009',$_SESSION['ultima_actualizacion']);
        
        require_once __DIR__ . '/../views/pedidos.php';
    }
}