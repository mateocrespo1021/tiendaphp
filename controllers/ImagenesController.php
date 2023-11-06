<?php

namespace Controllers;

use Classes\Paginacion;
use MVC\Router;
use Model\Imagen;
use Model\Producto;
use Intervention\Image\ImageManagerStatic as Image;

class ImagenesController
{

    public static function index(Router $router)
    {



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



        //Buscar todas las imagenes de ese producto
        $imagenes = Imagen::findProducts($id);



        // Render a la vista 
        $router->render('admin/imagenes/index', [
            'titulo' => 'Imagenes de ',
            "imagenes" => $imagenes,
            "producto" => $producto
        ]);
    }

    public static function crear(Router $router)
    {

        // if(!is_admin()){
        //     header("Location: /login");
        //  }

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


        $imagen=new Imagen;

      

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            // if(!is_admin()){
            //     header("Location: /login");
            //  } 

            if (!empty($_FILES["imagen"]["tmp_name"])) {
                $carpeta_imagenes = "../public/img/productos";
                //Crear la carpeta si existe
                if (!is_dir($carpeta_imagenes)) {
                    mkdir($carpeta_imagenes, 0755, true);
                }

                $imagen_png = Image::make($_FILES["imagen"]["tmp_name"])->fit(800, 800)->encode("png", 80);
                $imagen_webp = Image::make($_FILES["imagen"]["tmp_name"])->fit(800, 800)->encode("webp", 80);

                $nombre_imagen = md5(uniqid(rand(), true));

                $_POST["imagen"] = $nombre_imagen;
            }

            $imagen->sincronizar($_POST);
    
            //Validar
            $alertas = $imagen->validar();

            if (empty($alertas)) {
                $imagen_png->save($carpeta_imagenes . "/" . $nombre_imagen . ".png");
                $imagen_webp->save($carpeta_imagenes . "/" . $nombre_imagen . ".webp");

                $imagen->producto_id=$producto->id;


                $resultado = $imagen->guardar();

                if ($resultado) {
                    header("Location: /admin/imagenes?id=".$imagen->producto_id);
                }
            }
        }


        $router->render("admin/imagenes/crear", [
            "titulo" => "Añadir Imagen",
            "alertas" => $alertas,
            "imagen"=>$imagen,
            "producto"=>$producto
        ]);
    }

    public static function editar(Router $router)
    {

        // if(!is_admin()){
        //     header("Location: /login");
        //  }

        $alertas = [];

        //Validar el id
        $id = $_GET["id"];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        
        if (!$id) {
            header("Location: /admin/productos");
        }


        $imagen = Imagen::find($id);

        if (!$imagen) {
            header("Location: /admin/productos");
        }

        $imagen->imagen_actual=$imagen->imagen;


        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            // if(!is_admin()){
            //     header("Location: /login");
            //  } 

            if (!empty($_FILES["imagen"]["tmp_name"])) {
                $carpeta_imagenes = "../public/img/productos";
                //Crear la carpeta si existe
                if (!is_dir($carpeta_imagenes)) {
                    mkdir($carpeta_imagenes, 0755, true);
                }

                $imagen_png = Image::make($_FILES["imagen"]["tmp_name"])->fit(800, 800)->encode("png", 80);
                $imagen_webp = Image::make($_FILES["imagen"]["tmp_name"])->fit(800, 800)->encode("webp", 80);

                $nombre_imagen = md5(uniqid(rand(), true));

                $_POST["imagen"] = $nombre_imagen;
            }else{
                $_POST["imagen"] = $imagen->imagen;
            }

            $imagen->sincronizar($_POST);
    
            //Validar
            $alertas = $imagen->validar();

            if (empty($alertas)) {
                if (isset($nombre_imagen)) {
                    $imagen_png->save($carpeta_imagenes . "/" . $nombre_imagen . ".png");
                    $imagen_webp->save($carpeta_imagenes . "/" . $nombre_imagen . ".webp");
                    //Eliminamos la imagen anterior
                    $rutaImgPng = $carpeta_imagenes . "/" . $imagen->imagen_actual . ".png";
                    unlink($rutaImgPng);
                    $rutaImgWebp = $carpeta_imagenes . "/" . $imagen->imagen_actual . ".webp";
                    unlink($rutaImgWebp);
                }



                $resultado = $imagen->guardar();

                if ($resultado) {
                    header("Location: /admin/imagenes?id=".$imagen->producto_id);
                }
            }
        }


        $router->render("admin/imagenes/editar", [
            "titulo" => "Modificar Imagen",
            "alertas" => $alertas,
            "imagen"=>$imagen
        ]);
    }

    public static function eliminar()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            // if(!is_admin()){
            //     header("Location: /login");
            //  }
          
            $id = $_POST["id"];
            $imagen = Imagen::find($id);
            if (empty($imagen)) {
                header("Location: /admin/productos");
            }
          
            //Eliminamos la imagen anterior
            $carpeta_imagenes = "../public/img/productos";
            $rutaImgPng = $carpeta_imagenes . "/" . $imagen->imagen . ".png";
            unlink($rutaImgPng);
            $rutaImgWebp = $carpeta_imagenes . "/" . $imagen->imagen . ".webp";
            unlink($rutaImgWebp);
            $resultado = $imagen->eliminar();
            if ($resultado) {
                header("Location: /admin/imagenes?id=".$imagen->producto_id);
            }
        }
    }



}