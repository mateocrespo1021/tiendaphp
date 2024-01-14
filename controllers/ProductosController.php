<?php

namespace Controllers;

use Classes\Paginacion;
use Model\Categoria;
use Model\Producto;
use MVC\Router;
use Model\Imagen;
use Intervention\Image\ImageManagerStatic as Image;

class ProductosController
{

    public static function index(Router $router)
    {

        if (!is_admin()) {
            header("Location: /login");
        }


        $pagina_actual = $_GET["page"];
        $pagina_actual = filter_var($pagina_actual, FILTER_VALIDATE_INT);

        if (!$pagina_actual || $pagina_actual < 1) {
            header("Location: /admin/productos?page=1");
        }

        $por_pagina = 10;
        $total = Producto::total();
        $paginacion = new Paginacion($pagina_actual, $por_pagina, $total);
        $productos = Producto::paginar($por_pagina, $paginacion->offset());



        foreach ($productos as $producto) {
            $producto->categoria = Categoria::find($producto->categoria_id);
        }


        // Render a la vista 
        $router->render('admin/productos/index', [
            'titulo' => 'Productos',
            "productos" => $productos,
            "paginacion" => $paginacion->paginacion()
        ]);
    }

    public static function crear(Router $router)
    {



        if (!is_admin()) {
            header("Location: /login");
        }

        $alertas = [];

        $producto = new Producto;
        $categorias = Categoria::all();

        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            if (!is_admin()) {
                header("Location: /login");
            }
            //Leer imagen
            if (!empty($_FILES["portada"]["tmp_name"])) {
                $carpeta_imagenes = "../public/img/productos";
                //Crear la carpeta si existe
                if (!is_dir($carpeta_imagenes)) {
                    mkdir($carpeta_imagenes, 0755, true);
                }

                $imagen_png = Image::make($_FILES["portada"]["tmp_name"])->fit(800, 800)->encode("png", 80);
                $imagen_webp = Image::make($_FILES["portada"]["tmp_name"])->fit(800, 800)->encode("webp", 80);

                $nombre_imagen = md5(uniqid(rand(), true));

                $_POST["portada"] = $nombre_imagen;
            }


            $producto->sincronizar($_POST);

            //Validar
            $alertas = $producto->validar();

            if (empty($alertas)) {
                
                $imagen_png->save($carpeta_imagenes . "/" . $nombre_imagen . ".png");
                $imagen_webp->save($carpeta_imagenes . "/" . $nombre_imagen . ".webp");

                $resultado = $producto->guardar();

                if ($resultado) {
                    header("Location: /admin/productos");
                }
            }
        }


        // Render a la vista 
        $router->render('admin/productos/crear', [
            'titulo' => 'Registrar Producto',
            "alertas" => $alertas,
            "producto" => $producto,
            "categorias" => $categorias
        ]);
    }


    public static function editar(Router $router)
    {

        if (!is_admin()) {
            header("Location: /login");
        }

        $alertas = [];
        //Validar el id
        $id = $_GET["id"];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if (!$id) {
            header("Location: /admin/productos");
        }

        $producto = Producto::find($id);

        if (!$producto) {
            header("Location: /admin/productos");
        }

        $producto->portada_actual = $producto->portada;

        $categorias = Categoria::all();

        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            if (!is_admin()) {
                header("Location: /login");
            }

            //Leer imagen

            if (!empty($_FILES["portada"]["tmp_name"])) {
                $carpeta_imagenes = "../public/img/productos";
                //Crear la carpeta si existe
                if (!is_dir($carpeta_imagenes)) {
                    mkdir($carpeta_imagenes, 0755, true);
                }

                $imagen_png = Image::make($_FILES["portada"]["tmp_name"])->fit(800, 800)->encode("png", 80);
                $imagen_webp = Image::make($_FILES["portada"]["tmp_name"])->fit(800, 800)->encode("webp", 80);

                $nombre_imagen = md5(uniqid(rand(), true));

                $_POST["portada"] = $nombre_imagen;
            } else {
                $_POST["portada"] = $producto->portada_actual;
            }



            $producto->sincronizar($_POST);



            //Validar
            $alertas = $producto->validar();

            if (empty($alertas)) {
                if (isset($nombre_imagen)) {
                    $imagen_png->save($carpeta_imagenes . "/" . $nombre_imagen . ".png");
                    $imagen_webp->save($carpeta_imagenes . "/" . $nombre_imagen . ".webp");
                    //Eliminamos la imagen anterior
                    $rutaImgPng = $carpeta_imagenes . "/" . $producto->portada_actual . ".png";
                    unlink($rutaImgPng);
                    $rutaImgWebp = $carpeta_imagenes . "/" . $producto->portada_actual . ".webp";
                    unlink($rutaImgWebp);
                }


                $resultado = $producto->guardar();

                if ($resultado) {
                    header("Location: /admin/productos");
                }
            }
        }


        // Render a la vista 
        $router->render('admin/productos/editar', [
            'titulo' => 'Modificar Producto',
            "alertas" => $alertas,
            "producto" => $producto,
            "categorias" => $categorias
        ]);
    }

    public static function eliminar()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            if (!is_admin()) {
                header("Location: /login");
            }

            $id = $_POST["id"];
            $producto = Producto::find($id);
            if (empty($producto)) {
                header("Location: /admin/productos");
            }
            //Eliminamos la imagen anterior de la portada
            $carpeta_imagenes = "../public/img/productos";
            $rutaImgPng = $carpeta_imagenes . "/" . $producto->portada . ".png";
            unlink($rutaImgPng);
            $rutaImgWebp = $carpeta_imagenes . "/" . $producto->portada . ".webp";
            unlink($rutaImgWebp);

            //Eliminamos todas las imagenes del producto
            $imagenes = Imagen::whereArray(["producto_id" => $id]);

            foreach ($imagenes as $imagen) {
                $rutaImgPng = $carpeta_imagenes . "/" . $imagen->imagen . ".png";
                unlink($rutaImgPng);
                $rutaImgWebp = $carpeta_imagenes . "/" . $imagen->imagen . ".webp";
                unlink($rutaImgWebp);
            }

            $resultado = $producto->eliminar();


            if ($resultado) {
                header("Location: /admin/productos");
            }
        }
    }

}