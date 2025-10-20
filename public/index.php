<?php

require_once __DIR__ . '/../autoload.php';
require_once __DIR__.'/../config.php';

use App\Http\Request;
use App\Http\Server;


$server = new Server((new Request)->fromGlobal());

$server->router()->get('/ComanderaStore/','App\Controllers\PedidosController::PendientesBoedo1050');

$server->handler();