<?php
namespace Domain\Repositories;

use Core\Database\IdataSource;
use Domain\Entities\Oareti;
use Domain\Entities\Item;

class OaretiRepository {

    private IdataSource $dataSource; 

    public function __construct(IdataSource $db){
       
        $this->dataSource = $db;
    }

    public function getOaretis($deposito,$fecha){

        $result = [];

        $oaretis = $this->dataSource->getOareti('oareti',$deposito,$fecha);

        //Si no esta vacio 
        if(!empty($oaretis)){   

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

                $items = $this->dataSource->getItems($oareti->codfor,$oareti->nrofor);

                foreach ($items as $valor){

                    $item = new Item(
                        $valor['FCRMVI_TIPPRO'],
                        $valor['FCRMVI_ARTCOD'],
                        $valor['STMPDH_DESCRP'],
                        $valor['Pendiente']
                    );

                    $oareti->setItems($item);
                }

                array_push($result,$oareti);
            }

            return $result;
        }
        else{

            return false;
        }
    }
}
