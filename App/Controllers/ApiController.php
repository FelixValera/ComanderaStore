<?php
namespace App\Controllers;

use Domain\Repositories\OtomadasRepository;
use Domain\Entities\Otomada;

class ApiController{

    public static function TomarOrden($req,$param){
        
        $body = json_decode($req->body());

        $dateTime = date('Y-m-d H:i:s.v');
        
        $repository = new OtomadasRepository($req->dataSource);

        $otomada = new Otomada($body->codfor,$body->nrofor,$body->deposi,$dateTime);

        $response = $repository->create($otomada);

        header('Content-Type: application/json');
        echo json_encode($response);
        exit;
    }

    public static function GetOrdenesTomadas($req,$param){

        $fecha = date('Y-m-d');
        
        $repository = new OtomadasRepository($req->dataSource);

        $Otomadas = $repository->getOtomadas($param[0],$fecha);

        header('Content-Type: application/json');
        echo json_encode($Otomadas);
        exit;
    }
}