<?php

namespace Model;

class DetalleCompra extends ActiveRecord{
    protected static $tabla = 'detalle_compra';
    protected static $columnasDB = ['id', 'id_compra','id_producto','nombre','precio','cantidad','talla'];

    public $id;
    public $id_compra;

    public $id_producto;

    public $nombre;

    public $precio;

    public $cantidad;

    public $talla;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->id_compra = $args['id_compra'] ?? null;
        $this->id_producto = $args['id_producto'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->cantidad = $args['cantidad'] ?? '';
        $this->talla = $args['talla'] ?? '';
    }

}