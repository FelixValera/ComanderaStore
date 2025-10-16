<?php
namespace Core\Entities;

class Oareti {

    private $items = [];

    public $codfor;
    public $nrofor;
    public $codfac;
    public $nrofac;
    public $deposi;
    public $nombre;
    public $estaut;
    public $fechaAut;
    public $hora;
    public $pendientes;

    public function __construct(
        $codfor = '',
        $nrofor = '',
        $codfac = '',
        $nrofac = '',
        $deposi = '',
        $nombre = '',
        $estaut = '',
        $fechaAut = '',
        $hora = '',
        $pendientes = ''
    ) {
        $this->codfor = $codfor;
        $this->nrofor = $nrofor;
        $this->codfac = $codfac;
        $this->nrofac = $nrofac;
        $this->deposi = $deposi;
        $this->nombre = $nombre;
        $this->estaut = $estaut;
        $this->fechaAut = $fechaAut;
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
            'estaut' => $this->estaut,
            'fechaAut' => $this->fechaAut,
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
    H.FCRMVH_ESTAUT,
    CAST(H.FCRMVH_FCHAUT AS DATE) AS Fecha,
    FORMAT(H.FCRMVH_FCHAUT, 'HH:mm') AS Hora,
    SUM(I.FCRMVI_CANTID) AS Pendiente
*/