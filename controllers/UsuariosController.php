<?php

namespace Controllers;

use Classes\Email;
use Classes\Paginacion;
use Model\Usuario;
use MVC\Router;

class UsuariosController
{

    public static function index(Router $router)
    {
       
        if(!is_admin()){
            header("Location: /login");
         }

        $pagina_actual = $_GET["page"];
        $pagina_actual = filter_var($pagina_actual, FILTER_VALIDATE_INT);

        if (!$pagina_actual || $pagina_actual < 1) {
            header("Location: /admin/usuarios?page=1");
        }

        $por_pagina = 10;
        $total = Usuario::total('confirmado', 1);
        $paginacion = new Paginacion($pagina_actual, $por_pagina, $total);
        $usuarios = Usuario::paginarWhere($por_pagina, $paginacion->offset(), ['confirmado' => 1, 'admin' => 0]);

        
        // Render a la vista 
        $router->render('admin/usuarios/index', [
            'titulo' => 'Usuarios',
            "usuarios" => $usuarios,
            "paginacion" => $paginacion->paginacion()
        ]);
    }

    public static function desactivar()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            if(!is_admin()){
                header("Location: /login");
             }
            $id = $_POST["id"];
            $usuario = Usuario::find($id);


            if (empty($usuario)) {
                header("Location: /admin/usuarios");
            }
            //Desactivamos cuenta
            $usuario->estado = 0;
            $resultado = $usuario->guardar();
            if ($resultado) {
                header("Location: /admin/usuarios");
            }
        }
    }

    public static function activar()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            if(!is_admin()){
                header("Location: /login");
             }

            $id = $_POST["id"];
            $usuario = Usuario::find($id);


            if (empty($usuario)) {
                header("Location: /admin/usuarios");
            }
            //Desactivamos cuenta
            $usuario->estado = 1;
            $resultado = $usuario->guardar();
            if ($resultado) {
                header("Location: /admin/usuarios");
            }
        }
    }


    public static function enviarCorreo(Router $router)
    {

        $alertas = [];
     //   $email = new Email();



        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // if(!is_admin()){
            //     header("Location: /login");
            //  } 

           
        }

        $router->render("admin/usuarios/crear", [
            "titulo" => "Enviar Correo",
            "alertas" => $alertas,
           
        ]);

      
    }


}