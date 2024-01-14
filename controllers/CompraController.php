<?php

namespace Controllers;

use Classes\Paginacion;
use Model\Compra;
use Model\DetalleCompra;
use MVC\Router;


class CompraController
{
    public static function index(Router $router)
    {

         if(!is_admin()){
             header("Location: /login");
         }

        $pagina_actual = $_GET["page"];
        $pagina_actual = filter_var($pagina_actual, FILTER_VALIDATE_INT);

        if (!$pagina_actual || $pagina_actual < 1) {
            header("Location: /admin/ventas?page=1");
        }

        $por_pagina = 10;
        $total = Compra::total();
        $paginacion = new Paginacion($pagina_actual, $por_pagina, $total);
        $ventas = Compra::paginar($por_pagina, $paginacion->offset());


        // Render a la vista 
        $router->render('admin/ventas/index', [
            'titulo' => 'Ventas',
            "ventas" => $ventas,
            "paginacion" => $paginacion->paginacion()
        ]);
    }

    public static function detalle(Router $router)
    {

        if(!is_admin()){
            header("Location: /login");
         }

        //Validar el id
        $id = $_GET["id"];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if (!$id) {
            header("Location: /admin/ventas");
        }

        $detalles = DetalleCompra::findCompras($id);

        if (!$detalles) {
            header("Location: /admin/ventas");
        }

        // Render a la vista 
        $router->render('admin/ventas/detalle', [
            'titulo' => 'Ventas',
            "detalles" => $detalles
        ]);


    }


}