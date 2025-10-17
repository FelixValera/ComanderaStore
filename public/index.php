<?php
require_once '../autoload.php';
require_once '../config.php';

use Core\Database\SqlServerDataSource;
use Domain\Entities\Item;
use Domain\Repositories\OaretiRepository;
use Domain\Repositories\OdespaRepository;

$datasource = SqlServerDataSource::getInstance();

$odespas = new OdespaRepository($datasource);

$result = $odespas->getOdespas('0009','2025-10-16');

echo '<pre>';
    var_dump($result);
echo '</pre>';



// --------------------  Probando las Oaretis
/*
$datasource = SqlServerDataSource::getInstance();

$oaretis = $datasource->getOareti('oareti','0009','2025-10-16');

foreach ($oaretis as $valor){
    
    $oareti = new Oareti(
        $valor['FCRMVH_CODFOR'],
        $valor['FCRMVH_NROFOR'],
        $valor['Factura'],
        $valor['NroFactura'],
        $valor['FCRMVH_DEPOSI'],
        $valor['FCRMVH_NOMBRE'],
        $valor['FCRMVH_ESTAUT'],
        $valor['Fecha'],
        $valor['Hora'],
        $valor['Pendiente']
    );

    $items = $datasource->getItems($oareti->codfor,$oareti->nrofor);

    foreach ($items as $valor){

        $item = new Item(
            $valor['FCRMVI_TIPPRO'],
            $valor['FCRMVI_ARTCOD'],
            $valor['STMPDH_DESCRP'],
            $valor['Pendiente']
        );

        $oareti->setItems($item);
    }

    echo '<pre>';
        var_dump($oareti);
    echo '</pre>';
   
    die();
}
/*
H.FCRMVH_CODFOR,
H.FCRMVH_NROFOR,
H.USR_FCRMVH_CODFAC AS Factura,
H.USR_FCRMVH_NROFAC AS NroFactura,
H.FCRMVH_DEPOSI,
H.FCRMVH_NOMBRE,
H.FCRMVH_ESTAUT,
CAST(H.FCRMVH_FCHAUT AS DATE) AS Fecha,
FORMAT(H.FCRMVH_FCHAUT, 'HH:mm') AS Hora,
SUM(I.FCRMVI_CANTID) AS Pendiente
*/
// --------------------  Probando las Odespas
/*
$datasource = SqlServerDataSource::getInstance();

$odespas = $datasource->getOdespa('odespa','0009','2025-10-16');

foreach ($odespas as $valor){
    
    $odespa = new Odespa(
        $valor['FCRMVH_CODFOR'],
        $valor['FCRMVH_NROFOR'],
        $valor['Factura'],
        $valor['NroFactura'],
        $valor['FCRMVH_DEPOSI'],
        $valor['FCRMVH_NOMBRE'],
        $valor['Fecha'],
        $valor['Hora'],
        $valor['Pendiente']
    );

    $items = $datasource->getItems($odespa->codfor,$odespa->nrofor);

    foreach ($items as $valor){

        $item = new Item(
            $valor['FCRMVI_TIPPRO'],
            $valor['FCRMVI_ARTCOD'],
            $valor['STMPDH_DESCRP'],
            $valor['Pendiente']
        );

        $odespa->setItems($item);
    }

    echo '<pre>';
        var_dump($odespa);
    echo '</pre>';
   
    die();

}*/

/*
FCRMVI_TIPPRO, 
FCRMVI_ARTCOD, 
Producto.STMPDH_DESCRP, 
SUM(FCRMVI_CANTID) AS Pendiente

array(9) {
["FCRMVH_CODFOR"]=>
string(6) "ODESPA"
["FCRMVH_NROFOR"]=>
string(6) "342767"
["Factura"]=>
string(6) "FB0901"
["NroFactura"]=>
string(5) "54173"
["FCRMVH_DEPOSI"]=>
string(4) "0009"
["FCRMVH_NOMBRE"]=>
string(14) "  SAVAL DIANA "
["Fecha"]=>
string(10) "2025-10-16"
["Hora"]=>
string(5) "12:10"
["Pendiente"]=>
string(7) "12.0000"
*/
//crea los objetos de las odespas 
//$odespa = new Odespa()

/*
    string $codfor = '',
    string $nrofor = '',
    string $codfac = '',
    string $nrofac = '',
    string $deposi = '',
    string $nombre = '',
    string $fecha = '',
    string $hora = '',
    string $pendientes = ''

*/


//$items = $datasource->getItems($indice['FCRMVH_CODFOR'],$indice['FCRMVH_NROFOR'])



