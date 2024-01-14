<?php

namespace Model;

class Blog extends ActiveRecord
{
    protected static $tabla = 'blogs';
    protected static $columnasDB = ['id', 'titulo', 'contenido', 'fecha_publicacion', 'autor', 'etiquetas', 'imagen'];

    public $id;
    public $titulo;

    public $contenido;

    public $fecha_publicacion;

    public $autor;

    public $etiquetas;

    public $imagen;


    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->titulo = $args['titulo'] ?? '';
        $this->contenido = $args['contenido'] ?? '';
        $this->autor = $args['autor'] ?? '';
        $this->etiquetas = $args['etiquetas'] ?? '';
        $this->imagen = $args['imagen'] ?? '';

    }

    public function validar()
    {
        if (!$this->titulo) {
            self::$alertas['error'][] = 'El Nombre es Obligatorio';
        }

        if (!$this->contenido) {
            self::$alertas['error'][] = 'El Contenido es Obligatorio';
        }

        if (!$this->autor) {
            self::$alertas['error'][] = 'El Autor es Obligatorio';
        }

        if (!$this->etiquetas) {
            self::$alertas['error'][] = 'Las etiquetas son Obligatorias';
        }

        if (!$this->imagen) {
            self::$alertas['error'][] = 'La imagen es Obligatorio';
        }








        return self::$alertas;
    }

}