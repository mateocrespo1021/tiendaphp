<?php

namespace Controllers;

use Model\Categoria;

class APICategorias {

    public static function index() {
        $categorias = Categoria::total();
        echo json_encode($categorias);
    }

}