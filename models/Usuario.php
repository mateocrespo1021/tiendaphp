<?php

namespace Model;

class Usuario extends ActiveRecord
{
    protected static $tabla = 'usuarios';
    protected static $columnasDB = ['id', 'nombre', 'apellido', 'email', 'password', 'confirmado', 'token', 'admin'];

    public $id;
    public $nombre;
    public $apellido;
    public $email;

    public $password;
    public $confirmado;
    public $token;
    public $admin;



    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->confirmado = $args['portada'] ?? '';
        $this->stock = $args['stock'] ?? '';
    }

    public function validar()
    {
        if (!$this->nombre) {
            self::$alertas['error'][] = 'El Nombre es Obligatorio';
        }
        if (!$this->descripcion) {
            self::$alertas['error'][] = 'La descripcion es Obligatorio';
        }
        if (!$this->precio) {
            self::$alertas['error'][] = 'El precio es Obligatorio';
        }
        if (!$this->portada) {
            self::$alertas['error'][] = 'La portada es Obligatorio';
        }
        if (!$this->stock) {
            self::$alertas['error'][] = 'El stock es obligatoria';
        }

        if (!$this->tags) {
            self::$alertas['error'][] = 'Las tallas son obligatorias';
        }

        return self::$alertas;
    }



}