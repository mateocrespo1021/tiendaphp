<?php

namespace Model;

class Producto extends ActiveRecord{
    protected static $tabla = 'productos';
    protected static $columnasDB = ['id', 'nombre', 'descripcion', 'precio', 'tags','portada', 'stock', 'categoria_id'];

    public $id;
    public $nombre;
    public $descripcion;
    public $precio;

    public $tags;
    public $portada;
    public $stock;
    public $categoria_id;



    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->tags = $args['tags'] ?? '';
        $this->portada = $args['portada'] ?? '';
        $this->stock = $args['stock'] ?? '';
    }

    public function validar() {
        if(!$this->nombre) {
            self::$alertas['error'][] = 'El Nombre es Obligatorio';
        }
        if(!$this->descripcion) {
            self::$alertas['error'][] = 'La descripcion es Obligatorio';
        }
        if(!$this->precio) {
            self::$alertas['error'][] = 'El precio es Obligatorio';
        }
        if(!$this->portada) {
            self::$alertas['error'][] = 'La portada es Obligatorio';
        }
        if(!$this->stock) {
            self::$alertas['error'][] = 'El stock es obligatoria';
        }

        if(!$this->tags) {
            self::$alertas['error'][] = 'Las tallas son obligatorias';
        }
    
        return self::$alertas;
    }
    


}