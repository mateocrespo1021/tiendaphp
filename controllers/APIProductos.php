<?php

namespace Controllers;

use Model\Producto;

class APIProductos
{

    public static function buscarProducto()
    {
        $id = $_GET["id"] ?? "";
        $id = filter_var($id, FILTER_VALIDATE_INT);
        if (!$id) {
            echo json_encode([]);
            return;
        }

        $producto = Producto::find($id);
        echo json_encode($producto);
    }

}