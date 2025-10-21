<?php

require_once __DIR__ . '/../autoload.php';
require_once __DIR__.'/../config.php';

use App\Http\Request;
use App\Http\Server;
use Core\Database\SqlServerDataSource;

/* Prueba DB
use Core\Database\SqlServerDataSource;

$sql = SqlServerDataSource::getInstance();
*/

$server = new Server((new Request)->fromGlobal());

//middleware para agregar la DB
$server->use(function($req,$middleware){

    $req->dataSource = SqlServerDataSource::getInstance();
    
    $middleware->next($req);
});

$server->router()->get('/ComanderaStore/','App\Controllers\PedidosController::PendientesBoedo1050');

$server->handler();