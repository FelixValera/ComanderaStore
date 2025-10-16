<?php
namespace Core\Entities;

class Odespa {

    private $items = [];

    public $codfor;
    public $nrofor;
    public $codfac;
    public $nrofac;
    public $deposi;
    public $nombre;
    public $fecha;
    public $hora;
    public $pendientes;

    public function __construct(
        $codfor = '',
        $nrofor = '',
        $codfac = '',
        $nrofac = '',
        $deposi = '',
        $nombre = '',
        $fecha = '',
        $hora = '',
        $pendientes = ''
    ) {
        $this->codfor = $codfor;
        $this->nrofor = $nrofor;
        $this->codfac = $codfac;
        $this->nrofac = $nrofac;
        $this->deposi = $deposi;
        $this->nombre = $nombre;
        $this->fecha = $fecha;
        $this->hora = $hora;
        $this->pendientes = $pendientes;
    }

    public function setItems(Item $item){
        
        $this->items[] = $item;
    } 
    
    public function toArray(){

        return [
            'codfor' => $this->codfor,
            'nrofor' => $this->nrofor,
            'codfac' => $this->codfac,
            'nrofac' => $this->nrofac,
            'deposi' => $this->deposi,
            'nombre' => $this->nombre,
            'fechaAut' => $this->fecha,
            'hora' => $this->hora,
            'pendientes' => $this->pendientes
        ];
    }
}

/*
    H.FCRMVH_CODFOR,
    H.FCRMVH_NROFOR,
    H.USR_FCRMVH_CODFAC AS Factura,
    H.USR_FCRMVH_NROFAC AS NroFactura,
    H.FCRMVH_DEPOSI,
    H.FCRMVH_NOMBRE,
    CAST(H.FCRMVH_FECALT AS DATE) AS Fecha,
    FORMAT(H.FCRMVH_FECALT, 'HH:mm') AS Hora,
    SUM(I.FCRMVI_CANTID) AS Pendiente
*/