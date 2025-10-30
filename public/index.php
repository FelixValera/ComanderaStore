<?php

require_once __DIR__ . '/../autoload.php';
require_once __DIR__.'/../config.php';

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

//Si la uri no tiene API carga las siguientes rutas
$server->not('/api',function($server){

    $server->use(new SessionStartMiddleware());

    $server->router()->get('/ComanderaStore/','App\Controllers\PedidosController::PendientesBoedo1050');
});

//Si la uri tiene API carga las siguientes rutas
$server->if('/api',function($server){

    $server->router()->post('/ComanderaStore/api/tomar_orden','App\Controllers\ApiController::TomarOrden')

    ->get('/ComanderaStore/api/ordenes_tomadas/(\w+)','App\Controllers\ApiController::GetOrdenesTomadas');
});

$server->handler();