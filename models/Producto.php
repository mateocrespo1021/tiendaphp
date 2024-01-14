<?php

namespace Model;

class Producto extends ActiveRecord{
    protected static $tabla = 'productos';
    protected static $columnasDB = ['id', 'nombre', 'descripcion', 'precio', 'portada', 'categoria_id'];

    public $id;
    public $nombre;
    public $descripcion;
    public $precio;

    public $portada;
    public $categoria_id;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->portada = $args['portada'] ?? '';
        $this->categoria_id = $args['catogoria_id'] ?? null;
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
        if(!$this->categoria_id) {
            self::$alertas['error'][] = 'La categoria es obligatoria';
        }
    
        return self::$alertas;
    }
    


}