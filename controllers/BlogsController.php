<?php

namespace Controllers;

use Classes\Paginacion;
use Model\Blog;
use MVC\Router;
use Intervention\Image\ImageManagerStatic as Image;

class BlogsController
{

    public static function index(Router $router)
    {

        if (!is_admin()) {
            header("Location: /login");
        }

        $pagina_actual = $_GET["page"];
        $pagina_actual = filter_var($pagina_actual, FILTER_VALIDATE_INT);

        if (!$pagina_actual || $pagina_actual < 1) {
            header("Location: /admin/blogs?page=1");
        }

        $por_pagina = 5;
        $total = Blog::total();
        $paginacion = new Paginacion($pagina_actual, $por_pagina, $total);
        $blogs = Blog::paginar($por_pagina, $paginacion->offset());


        // Render a la vista 
        $router->render('admin/blogs/index', [
            'titulo' => 'Blogs',
            "blogs" => $blogs,
            "paginacion" => $paginacion->paginacion()
        ]);
    }

    public static function crear(Router $router)
    {



        if (!is_admin()) {
            header("Location: /login");
        }

        $alertas = [];

        $blog = new Blog;

        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            if (!is_admin()) {
                header("Location: /login");
            }


            //Leer imagen
            if (!empty($_FILES["imagen"]["tmp_name"])) {
                $carpeta_imagenes = "../public/img/blog";
                //Crear la carpeta si existe
                if (!is_dir($carpeta_imagenes)) {
                    mkdir($carpeta_imagenes, 0755, true);
                }

                $imagen_png = Image::make($_FILES["imagen"]["tmp_name"])->fit(800, 800)->encode("png", 80);
                $imagen_webp = Image::make($_FILES["imagen"]["tmp_name"])->fit(800, 800)->encode("webp", 80);

                $nombre_imagen = md5(uniqid(rand(), true));

                $_POST["imagen"] = $nombre_imagen;
            }


            $blog->sincronizar($_POST);

            //Validar
            $alertas = $blog->validar();

            //debuguear($blog);

            if (empty($alertas)) {
                $imagen_png->save($carpeta_imagenes . "/" . $nombre_imagen . ".png");
                $imagen_webp->save($carpeta_imagenes . "/" . $nombre_imagen . ".webp");

                $blog->fecha_publicacion = date('Y-m-d');

                $resultado = $blog->guardar();

                if ($resultado) {
                    header("Location: /admin/blogs");
                }
            }
        }


        // Render a la vista 
        $router->render('admin/blogs/crear', [
            'titulo' => 'Crear Blog',
            "alertas" => $alertas,
            "blog" => $blog
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
            header("Location: /admin/blogs");
        }

        $blog = Blog::find($id);

        if (!$blog) {
            header("Location: /admin/blogs");
        }

        $blog->imagen_actual = $blog->imagen;


        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            if (!is_admin()) {
                header("Location: /login");
            }

            //Leer imagen

            if (!empty($_FILES["imagen"]["tmp_name"])) {
                $carpeta_imagenes = "../public/img/blog";
                //Crear la carpeta si existe
                if (!is_dir($carpeta_imagenes)) {
                    mkdir($carpeta_imagenes, 0755, true);
                }

                $imagen_png = Image::make($_FILES["imagen"]["tmp_name"])->fit(800, 800)->encode("png", 80);
                $imagen_webp = Image::make($_FILES["imagen"]["tmp_name"])->fit(800, 800)->encode("webp", 80);

                $nombre_imagen = md5(uniqid(rand(), true));

                $_POST["imagen"] = $nombre_imagen;
            } else {
                $_POST["imagen"] = $blog->imagen_actual;
            }

            $blog->sincronizar($_POST);

            //Validar
            $alertas = $blog->validar();

            if (empty($alertas)) {
                if (isset($nombre_imagen)) {
                    $imagen_png->save($carpeta_imagenes . "/" . $nombre_imagen . ".png");
                    $imagen_webp->save($carpeta_imagenes . "/" . $nombre_imagen . ".webp");
                    //Eliminamos la imagen anterior
                    $rutaImgPng = $carpeta_imagenes . "/" . $blog->imagen_actual . ".png";
                    unlink($rutaImgPng);
                    $rutaImgWebp = $carpeta_imagenes . "/" . $blog->imagen_actual . ".webp";
                    unlink($rutaImgWebp);
                }


                $resultado = $blog->guardar();

                if ($resultado) {
                    header("Location: /admin/blogs");
                }
            }
        }


        // Render a la vista 
        $router->render('admin/blogs/editar', [
            'titulo' => 'Modificar Blog',
            "alertas" => $alertas,
            "blog" => $blog
        ]);
    }

    public static function eliminar()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            if (!is_admin()) {
                header("Location: /login");
            }

            $id = $_POST["id"];
            $blog = Blog::find($id);
            if (empty($blog)) {
                header("Location: /admin/blogs");
            }
            //Eliminamos la imagen anterior de la portada
            $carpeta_imagenes = "../public/img/blog";
            $rutaImgPng = $carpeta_imagenes . "/" . $blog->imagen . ".png";
            unlink($rutaImgPng);
            $rutaImgWebp = $carpeta_imagenes . "/" . $blog->imagen . ".webp";
            unlink($rutaImgWebp);
            $resultado = $blog->eliminar();
            if ($resultado) {
                header("Location: /admin/blogs");
            }
        }
    }

}