<?php
namespace Domain\Entities;

class Otomada {

    public $codfor;
    public $nrofor;
    public $deposi;
    public $dateTime;
    
    public function __construct(
        $codfor = '',
        $nrofor = '',
        $deposi = '',
        $dataTime = ''
    ) {
        $this->codfor = $codfor;
        $this->nrofor = $nrofor;
        $this->deposi = $deposi;
        $this->dateTime = $dataTime;
    }

    public function toArray(){

        return [
            'CODFOR' => $this->codfor,
            'NROFOR' => $this->nrofor,
            'DEPOSI' => $this->deposi,
            'FECALT' => $this->dateTime,
        ];
    }
}