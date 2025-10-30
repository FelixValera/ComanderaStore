<?php
namespace Domain\Entities;

class Odespa {

    public $items = [];
    public $codfor;
    public $nrofor;
    public $codfac;
    public $nrofac;
    public $deposi;
    public $nombre;
    public $vendedor;
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
        $vendedor = '',
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
        $this->vendedor = $vendedor;
        $this->fecha = $fecha;
        $this->hora = $hora;
        $this->pendientes = $pendientes;
    }

    public function setItems(Item $item){
        
        $this->items[] = $item;
    }

    public function getDelay():int{ 

        // Crear objeto DateTime con la hora proporcionada
        $horaProporcionada = \DateTime::createFromFormat('H:i',$this->hora);

        //Obtener la hora actual del sistema
        //$horaActual = \DateTime::createFromFormat('H:i','19:11'); PRUEBA
        $horaActual = new \DateTime();
        
        // Calcular la diferencia
        $diferencia = $horaActual->diff($horaProporcionada);

        $diferenciaMinutos = ($diferencia->h * 60) + $diferencia->i;
        
        return  $diferenciaMinutos;
    }
    
    public function toArray(){

        return [
            'codfor' => $this->codfor,
            'nrofor' => $this->nrofor,
            'codfac' => $this->codfac,
            'nrofac' => $this->nrofac,
            'deposi' => $this->deposi,
            'nombre' => $this->nombre,
            'vendedor' => $this->vendedor,
            'fechaAut' => $this->fecha,
            'hora' => $this->hora,
            'pendientes' => $this->pendientes
        ];
    }
}
