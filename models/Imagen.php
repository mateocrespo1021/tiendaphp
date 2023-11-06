<?php

namespace Model;

class Imagen extends ActiveRecord{
    protected static $tabla = 'imagenes';
    protected static $columnasDB = ['id', 'producto_id','imagen'];

    public $id;
    public $producto_id;
    public $imagen;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->producto_id = $args['producto_id'] ?? null;
        $this->imagen = $args['imagen'] ?? "";
    }

    public function validar() {
        if(!$this->imagen) {
            self::$alertas['error'][] = 'La imagen es Obligatorio';
        }
  
    
        return self::$alertas;
    }
    


}