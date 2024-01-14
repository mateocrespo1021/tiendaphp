<?php

namespace Model;

class Compra extends ActiveRecord{
    protected static $tabla = 'compra';
    protected static $columnasDB = ['id', 'id_transaccion','fecha','status','email','id_cliente','total'];

    public static function agregarColumna($nombreColumna) {
        // Agregar una nueva columna a $columnasDB
        static::$columnasDB[] = $nombreColumna;
    }

    public $id;
    public $id_transaccion;

    public $fecha;

    public $status;

    public $email;

    public $id_cliente;

    public $total;

 

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->id_transaccion = $args['id_transaccion'] ?? '';
        $this->fecha = $args['fecha'] ?? '';
        $this->status = $args['status'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->id_cliente = $args['id_cliente'] ?? '';
        $this->total = $args['total'] ?? '';
    }

}