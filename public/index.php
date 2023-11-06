<?php


require_once __DIR__ . '/../includes/app.php';

use Controllers\APICategorias;
use Controllers\APIProductos;
use Controllers\CategoriasController;
use Controllers\DashboardController;
use Controllers\ImagenesController;
use Controllers\PaginasController;
use Controllers\ProductosController;
use MVC\Router;


$router = new Router();


//Area publica
$router->get('/', [PaginasController::class, 'index']);
$router->get('/productos', [PaginasController::class, 'productos']);
$router->get('/ver-producto', [PaginasController::class, 'producto']);
$router->get('/carrito', [PaginasController::class, 'carrito']);
//Dashboard
$router->get('/admin/dashboard', [DashboardController::class, 'index']);
//CRUD Productos
$router->get('/admin/productos', [ProductosController::class, 'index']);
$router->get('/admin/productos/crear', [ProductosController::class, 'crear']);
$router->post('/admin/productos/crear', [ProductosController::class, 'crear']);
$router->get('/admin/productos/editar', [ProductosController::class, 'editar']);
$router->post('/admin/productos/editar', [ProductosController::class, 'editar']);
$router->post('/admin/productos/eliminar', [ProductosController::class, 'eliminar']);
//CRUD Categorias
$router->get('/admin/categorias', [CategoriasController::class, 'index']);
$router->get('/admin/categorias/crear', [CategoriasController::class, 'crear']);
$router->post('/admin/categorias/crear', [CategoriasController::class, 'crear']);
$router->get('/admin/categorias/editar', [CategoriasController::class, 'editar']);
$router->post('/admin/categorias/editar', [CategoriasController::class, 'editar']);
$router->post('/admin/categorias/eliminar', [CategoriasController::class, 'eliminar']);
//CRUD IMAGENES
$router->get('/admin/imagenes', [ImagenesController::class, 'index']);
$router->get('/admin/imagenes/crear', [ImagenesController::class, 'crear']);
$router->post('/admin/imagenes/crear', [ImagenesController::class, 'crear']);
$router->get('/admin/imagenes/editar', [ImagenesController::class, 'editar']);
$router->post('/admin/imagenes/editar', [ImagenesController::class, 'editar']);
$router->post('/admin/imagenes/eliminar', [ImagenesController::class, 'eliminar']);
//APIS
$router->get('/api/categorias-total', [APICategorias::class, 'index']);
$router->get('/api/buscar-producto', [APIProductos::class, 'buscarProducto']);
$router->comprobarRutas();
