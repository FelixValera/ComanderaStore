<?php
namespace App\Controllers;

use Domain\Repositories\OdespaRepository;
use Domain\Repositories\OaretiRepository;
use Domain\Repositories\OtomadasRepository;

class PedidosController{

    public static function PendientesBoedo1050($req,$param){
        
        $deposito = '0009';
        $sucursal = 'BOEDO 1050';
        $date = date('Y-m-d'); //fecha actual
        //$date = '2026-01-19'; //fecha de prueba

        $odespas = new OdespaRepository($req->dataSource);
        $oaretis = new OaretiRepository($req->dataSource);
        $Otomadas = new OtomadasRepository($req->dataSource);
        
        $odespasPendientes = $odespas->getOdespas($deposito,$date);
        $oaretisPendientes = $oaretis->getOaretis($deposito,$date);

        $Otomadas->deleteOtomadas($deposito,$date); //Elimina las ordenes tomadas ya despachadas
        
        $nuevasOdespas = $odespas->getNuevas($deposito,$_SESSION['ultima_actualizacion']);
        $nuevasOaretis = $oaretis->getNuevas($deposito,$_SESSION['ultima_actualizacion']);
        
        require_once __DIR__ . '/../views/pedidos.php';
    }

    public static function Cabildo($req,$param){

        $deposito = '0007';
        $sucursal = 'CABILDO';
        $date = date('Y-m-d'); //fecha actual
        //$date = '2025-10-16'; //fecha de prueba

        $odespas = new OdespaRepository($req->dataSource);
        $oaretis = new OaretiRepository($req->dataSource);
        $Otomadas = new OtomadasRepository($req->dataSource);
        
        $odespasPendientes = $odespas->getOdespas($deposito,$date);
        $oaretisPendientes = $oaretis->getOaretis($deposito,$date);

        $Otomadas->deleteOtomadas($deposito,$date); //Elimina las ordenes tomadas ya despachadas
        
        $nuevasOdespas = $odespas->getNuevas($deposito,$_SESSION['ultima_actualizacion']);
        $nuevasOaretis = $oaretis->getNuevas($deposito,$_SESSION['ultima_actualizacion']);
        
        require_once __DIR__ . '/../views/pedidos.php';
    }
}