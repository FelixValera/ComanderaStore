<?php
namespace Domain\Repositories;

use Core\Database\IdataSource;
use Domain\Entities\Otomada;

class OtomadasRepository {

    private IdataSource $_dataSource; 

    public function __construct(IdataSource $db){
       
        $this->_dataSource = $db;
    }

    public function create(Otomada $otomada){

        $response = $this->_dataSource->create('OrderFlow.dbo.ordenes_tomadas',$otomada->toArray());

        return $response;
    }

    public function getOtomadas($deposi,$fecha){

        $result = [];

        $odespas = $this->_dataSource->getOtomadas($deposi,$fecha);

        //Si no esta vacio 
        if(!empty($odespas)){   

            foreach ($odespas as $valor){

                $odespa = new Otomada(
                    $valor['CODFOR'],
                    $valor['NROFOR'],
                    $valor['DEPOSI'],
                    $valor['FECALT'],
                );

                array_push($result,$odespa);
            }

            return $result;
        }
        else{

            return false;
        }
    }

    public function deleteOtomadas($deposi,$fecha){

        $response = $this->_dataSource->deleteOtomadas($deposi,$fecha);

        return $response;
    }

}