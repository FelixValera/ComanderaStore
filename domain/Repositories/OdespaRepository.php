<?php
namespace Domain\Repositories;

use Core\Database\IdataSource;
use Domain\Entities\Odespa;
use Domain\Entities\Item;

class OdespaRepository {

    private IdataSource $_dataSource; 

    public function __construct(IdataSource $db){
       
        $this->_dataSource = $db;
    }

    public function getOdespas($deposito,$fecha){

        $result = [];

        $odespas = $this->_dataSource->getOdespa('odespa',$deposito,$fecha);

        //Si no esta vacio 
        if(!empty($odespas)){   

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

                $items = $this->_dataSource->getItems($odespa->codfor,$odespa->nrofor);

                foreach ($items as $valor){

                    $item = new Item(
                        $valor['FCRMVI_TIPPRO'],
                        $valor['FCRMVI_ARTCOD'],
                        $valor['STMPDH_DESCRP'],
                        $valor['Pendiente']
                    );

                    $odespa->setItems($item);
                }

                array_push($result,$odespa);
            }

            return $result;
        }
        else{

            return false;
        }
    }
}