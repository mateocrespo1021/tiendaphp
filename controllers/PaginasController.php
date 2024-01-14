<?php

namespace Controllers;

use Classes\Email;
use Model\Blog;
use Model\Categoria;
use Model\Compra;
use Model\DetalleCompra;
use Model\Producto;
use Model\Talla;
use Model\Usuario;
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
        $categorias = Categoria::all();


        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            if (isset($_POST['nombre']) && !empty($_POST["nombre"])) {
                $productos = Producto::whereArray(["nombre" => $_POST["nombre"]]);
            } else if (isset($_POST['categoria_id']) && !empty($_POST["categoria_id"])) {
                $productos = Producto::whereArray(["categoria_id" => $_POST["categoria_id"]]);
            } else if (isset($_POST['precio']) && !empty($_POST["precio"])) {
                $productos = Producto::wherePrecio("precio", $_POST["precio"]);
            }
        }

        $router->render("paginas/productos", ["titulo" => "Productos", "subtitulo" => "MARCA DE ROPA DE MUJER", "productos" => $productos, "categorias" => $categorias]);
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
        $tallas = Talla::findProducts($id);

        $router->render("paginas/producto", ["titulo" => "Productos", "subtitulo" => "MARCA DE ROPA DE MUJER", "producto" => $producto, "imagenes" => $imagenes, "tallas" => $tallas]);
    }


    public static function acerca(Router $router)
    {
        $router->render("paginas/acerca", ["titulo" => "Acerca de VidaEtc."]);
    }


    public static function blogs(Router $router)
    {

        $blogs = Blog::all();

        $router->render("paginas/blogs", ["titulo" => "Blogs de VidaEtc.", "blogs" => $blogs]);
    }



    public static function blog(Router $router)
    {

        $id = $_GET["id"];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if (!$id) {
            header("Location: /blogs");
        }

        $blog = Blog::find($id);

        if (!$blog) {
            header("Location: /blogs");
        }



        $router->render("paginas/blog", ["titulo" => $blog->titulo, "blog" => $blog]);
    }

    public static function error(Router $router)
    {

        $router->render('paginas/error', [
            'titulo' => 'Página no encontrada'
        ]);
    }

    public static function historial(Router $router)
    {

        $id = $_GET["id"];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if (!$id) {
            header("Location: /");
        }

        $compras = Compra::whereArray(['id_usuario' => $id]);

        foreach ($compras as $compra) {
            $detallesCompra = DetalleCompra::whereArray(['id_compra' => $compra->id]);
            $compra->detalles_compra = $detallesCompra;
        }

        $router->render("paginas/historial-compras", ["titulo" => "Historial de Compras", "compras" => $compras]);
    }

    public static function pagar(Router $router)
    {
        $router->render("paginas/pagar", ["titulo" => "Pago"]);
    }


    public static function contacto(Router $router)
    {

        $alertas = [];
        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            $vacios = false;
            // Lista de campos requeridos
            $campos_requeridos = array("nombre", "asunto", "mensaje", "telefono", "email");

            // Validar cada campo
            foreach ($campos_requeridos as $campo) {
                if (empty($_POST[$campo])) {
                    $alertas['error'][] = "El campo '$campo' es requerido.";
                    $vacios = true;
                }
            }

            if (!$vacios) {
                $mail = new Email("matcre01@gmail.com", "VIDAETC");
                $mail->enviarContacto($_POST);
                $alertas['exito'][] = "Mensaje enviado éxitosamente";
            }


        }


        $router->render("paginas/contacto", ["titulo" => "Contacto", 'alertas' => $alertas, 'contacto' => $_POST]);
    }
}
