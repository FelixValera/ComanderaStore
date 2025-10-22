<?php
namespace Domain\Entities;

class Item{
    
    public $tipo;
    public $articulo;
    public $descripcion;
    public $pendientes;

    public function __construct(
        $tipo = '',
        $articulo = '',
        $descripcion = '',
        $pendientes = ''
    ) {
        $this->tipo = $tipo;
        $this->articulo = $articulo;
        $this->descripcion = $descripcion;
        $this->pendientes = $pendientes;
    }
    
    public function toArray(){

        return [
            'tipo' => $this->tipo,
            'articulo' => $this->articulo,
            'descripcion' => $this->descripcion,
            'pendientes' => $this->pendientes,
        ];
    }

    //Devuelve el valor tipo entero
    public function getPendientes(){

        return (int)$this->pendientes;
    }
}