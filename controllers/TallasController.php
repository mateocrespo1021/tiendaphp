<?php

namespace Controllers;

use Classes\Paginacion;
use Model\Producto;
use Model\Talla;
use MVC\Router;

class TallasController
{

    public static function index(Router $router)
    {

        if(!is_admin()){
            header("Location: /login");
         }

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



        //Buscar todas las tallas y stock de ese producto
        $tallas = Talla::findProducts($id);



        // Render a la vista 
        $router->render('admin/tallas/index', [
            'titulo' => 'Tallas '. $producto->nombre,
            "tallas" => $tallas,
            "producto"=>$producto
        ]);
    }

    public static function crear(Router $router)
    {

        if(!is_admin()){
            header("Location: /login");
         }

        $alertas = [];
        $talla = new Talla();

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




        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(!is_admin()){
                header("Location: /login");
             } 

            

            $talla->sincronizar($_POST);
            $alertas = $talla->validar();
            if (empty($alertas)) {
                $talla->producto_id=$id; 
                $resultado = $talla->guardar();
                if ($resultado) {
                    header("Location: /admin/tallas?id=" . $producto->id);
                }
            }
        }

        $router->render("admin/tallas/crear", [
            "titulo" => "Registrar Talla",
            "alertas" => $alertas,
            "talla" => $talla
        ]);
    }


    public static function editar(Router $router)
    {

        if(!is_admin()){
            header("Location: /login");
         }

        $alertas = [];

        $id = $_GET["id"];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if (!$id) {
            header("Location: /admin/tallas");
        }



        $talla = Talla::find($id);



        if (!$talla) {
            header("Location: /admin/tallas");
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(!is_admin()){
                header("Location: /login");
             } 

            $talla->sincronizar($_POST);
            $alertas = $talla->validar();
            if (empty($alertas)) {

                $resultado = $talla->guardar();
                if ($resultado) {
                    header("Location: /admin/tallas?id=" . $talla->producto_id);
                }
            }
        }

        $router->render("admin/tallas/editar", [
            "titulo" => "Modificar Talla",
            "alertas" => $alertas,
            "talla" => $talla
        ]);
    }


    public static function eliminar()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            if(!is_admin()){
                header("Location: /login");
             }

            $id = $_POST["id"];
            $talla = talla::find($id);
            if (empty($talla)) {
                header("Location: /admin/tallas");
            }

            $resultado = $talla->eliminar();
            if ($resultado) {
                header("Location: /admin/tallas?id=" . $talla->producto_id);
            }
        }
    }



}