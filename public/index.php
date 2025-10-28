<?php

require_once __DIR__ . '/../autoload.php';
require_once __DIR__.'/../config.php';

/*
use App\Http\Request;
use App\Http\Server;
use Core\Database\SqlServerDataSource;
use App\Http\Middlewares\SessionStartMiddleware;


$server = new Server((new Request)->fromGlobal());

//middleware para agregar la DB
$server->use(function($req,$middleware){

    $req->dataSource = SqlServerDataSource::getInstance();
    
    $middleware->next($req);
});

$server->use(new SessionStartMiddleware());

$server->router()->get('/ComanderaStore/','App\Controllers\PedidosController::PendientesBoedo1050');

$server->handler();
*/

/* ---------- Probando los Repository y las Entidades ----------

use Core\Database\SqlServerDataSource;
Use Domain\Repositories\OtomadasRepository;
use Domain\Entities\Otomada;

//$date = date('Y-m-d H:i:s.v');

$date = date('Y-m-d');

//$otomada = new Otomada('ODESPA','159783','0009',$date);

$otomadaRepository = new OtomadasRepository(SqlServerDataSource::getInstance());
//$response = $otomadaRepository->create($otomada);

$response = $otomadaRepository->getOtomadas('0009','2025-10-27');

var_dump($response);

die();

*/