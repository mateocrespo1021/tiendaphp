<?php

namespace Model;

class Talla extends ActiveRecord
{
    protected static $tabla = 'tallas';
    protected static $columnasDB = ['id', 'nombre', 'stock', 'producto_id'];

    public $id;
    public $producto_id;
    public $nombre;

    public $stock;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->producto_id = $args['producto_id'] ?? null;
        $this->nombre = $args['nombre'] ?? "";
        $this->stock = $args['stock'] ?? 0;
    }


    public function validar()
    {
        if (!$this->nombre) {
            self::$alertas['error'][] = 'El Nombre es Obligatorio';
        }

        if (!$this->stock) {
            self::$alertas['error'][] = 'El Stock es Obligatorio';
        }
        return self::$alertas;
    }

}