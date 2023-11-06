<?php

namespace Controllers;

use Model\Producto;
use MVC\Router;
use Model\Imagen;

class PaginasController
{

    public static function index(Router $router)
    {
        $router->render("paginas/index", ["titulo" => "Inicio", "subtitulo" => "MARCA DE ROPA DE MUJER"]);
    }

    public static function productos(Router $router)
    {
        $productos = Producto::all();
        $router->render("paginas/productos", ["titulo" => "Productos", "subtitulo" => "MARCA DE ROPA DE MUJER", "productos" => $productos]);
    }
    public static function producto(Router $router)
    {

        $id = $_GET["id"];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if (!$id) {
            header("Location: /productos");
        }

        $producto = Producto::find($id);

        if (!$producto) {
            header("Location: /productos");
        }

        $imagenes = Imagen::findProducts($id);
        $tallas = explode(",", $producto->tags);

        $router->render("paginas/producto", ["titulo" => "Productos", "subtitulo" => "MARCA DE ROPA DE MUJER", "producto" => $producto, "imagenes" => $imagenes, "tallas" => $tallas]);
    }

    public static function carrito(Router $router)
    {

        $router->render("paginas/carrito", ["titulo" => "Productos", "subtitulo" => "MARCA DE ROPA DE MUJER"]);
    }
}
