<?php

namespace Controllers;

use Classes\Paginacion;
use Model\Categoria;
use MVC\Router;

class CategoriasController
{

    public static function index(Router $router)
    {

        // if(!is_admin()){
        //     header("Location: /login");
        //  }

         $pagina_actual=$_GET["page"];
         $pagina_actual=filter_var($pagina_actual,FILTER_VALIDATE_INT);

         if (!$pagina_actual || $pagina_actual<1) {
             header("Location: /admin/categorias?page=1");
         }

         $por_pagina=10;
         $total=Categoria::total();
         $paginacion=new Paginacion($pagina_actual,$por_pagina,$total);
         $categorias=Categoria::paginar($por_pagina,$paginacion->offset());

        

        // Render a la vista 
        $router->render('admin/categorias/index', [
            'titulo' => 'Categorias Productos',
            "categorias" => $categorias,
            "paginacion"=>$paginacion->paginacion()
        ]);
    }

    public static function crear(Router $router)
    {

        // if(!is_admin()){
        //     header("Location: /login");
        //  }

        $alertas = [];
        $categoria = new Categoria();



        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // if(!is_admin()){
            //     header("Location: /login");
            //  } 

            $categoria->sincronizar($_POST);
            $alertas = $categoria->validar();
            if (empty($alertas)) {

                $resultado = $categoria->guardar();
                if ($resultado) {
                    header("Location: /admin/categorias");
                }
            }
        }

        $router->render("admin/categorias/crear", [
            "titulo" => "Registrar Categoria",
            "alertas" => $alertas,
            "categoria" => $categoria
        ]);
    }


    public static function editar(Router $router)
    {

        // if(!is_admin()){
        //     header("Location: /login");
        //  }

        $alertas = [];

        $id = $_GET["id"];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if (!$id) {
            header("Location: /admin/categorias");
        }



        $categoria = Categoria::find($id);

        if (!$categoria) {
            header("Location: /admin/categorias");
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // if(!is_admin()){
            //     header("Location: /login");
            //  } 

            $categoria->sincronizar($_POST);
            $alertas = $categoria->validar();
            if (empty($alertas)) {

                $resultado = $categoria->guardar();
                if ($resultado) {
                    header("Location: /admin/categorias");
                }
            }
        }

        $router->render("admin/categorias/editar", [
            "titulo" => "Modificar Categoria",
            "alertas" => $alertas,
            "categoria" => $categoria
        ]);
    }


    public static function eliminar()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            // if(!is_admin()){
            //     header("Location: /login");
            //  }
          
            $id = $_POST["id"];
            $categoria = Categoria::find($id);
            if (empty($categoria)) {
                header("Location: /admin/categorias");
            }
            $resultado = $categoria->eliminar();
            if($resultado) {
                echo json_encode([
                    'resultado' => $resultado
                ]);
            } else {
                echo json_encode(['resultado' => false]);
            }
        }
    }



}