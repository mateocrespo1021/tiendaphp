<?php

namespace Model;

class Invoice extends ActiveRecord
{
    protected static $tabla = 'invoice';
    protected static $columnasDB = ['id', 'nombres', 'apellidos', 'telefono', 'email', 'pais', 'departamento', 'provincia', 'codigo_postal', 'id_compra'];

    public $id;
    public $nombres;
    public $apellidos;

    public $telefono;

    public $email;

    public $pais;

    public $departamento;

    public $provincia;

    public $codigo_postal;

    public $id_compra;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombres = $args['nombres'] ?? "";
        $this->apellidos = $args['apellidos'] ?? "";
        $this->email = $args['email'] ?? "";
        $this->pais = $args['pais'] ?? "";
        $this->telefono = $args['telefono'] ?? "";
        $this->departamento = $args['departamento'] ?? "";
        $this->provincia = $args['provincia'] ?? "";
        $this->codigo_postal = $args['codigo_postal'] ?? "";
        $this->id_compra = $args['id_compra'] ?? null;
    }



}