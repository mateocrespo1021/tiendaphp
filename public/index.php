<?php


require_once __DIR__ . '/../includes/app.php';

use Controllers\APICategorias;
use Controllers\APIPaypal;
use Controllers\APIProductos;
use Controllers\APIVentas;
use Controllers\AuthController;
use Controllers\BlogsController;
use Controllers\CategoriasController;
use Controllers\CompraController;
use Controllers\DashboardController;
use Controllers\ImagenesController;
use Controllers\PaginasController;
use Controllers\ProductosController;
use Controllers\ReportesController;
use Controllers\TallasController;
use Controllers\UsuariosController;
use MVC\Router;


$router = new Router();


//Area publica
$router->get('/', [PaginasController::class, 'index']);
$router->get('/productos', [PaginasController::class, 'productos']);
$router->post('/productos', [PaginasController::class, 'productos']);
$router->get('/ver-producto', [PaginasController::class, 'producto']);
$router->get('/acerca', [PaginasController::class, 'acerca']);
$router->get('/blogs', [PaginasController::class, 'blogs']);
$router->get('/blog', [PaginasController::class, 'blog']);
$router->get('/historial', [PaginasController::class, 'historial']);
$router->get('/404', [PaginasController::class, 'error']);
$router->get('/pagar', [PaginasController::class, 'pagar']);
$router->get('/contacto', [PaginasController::class, 'contacto']);
$router->post('/contacto', [PaginasController::class, 'contacto']);
// Login
$router->get('/login', [AuthController::class, 'login']);
$router->post('/login', [AuthController::class, 'login']);
$router->post('/logout', [AuthController::class, 'logout']);
// Crear Cuenta
$router->get('/registro', [AuthController::class, 'registro']);
$router->post('/registro', [AuthController::class, 'registro']);
$router->get('/mensaje', [AuthController::class, 'mensaje']);
//Olvide Cuenta
$router->get('/olvide', [AuthController::class, 'olvide']);
$router->post('/olvide', [AuthController::class, 'olvide']);
// Colocar el nuevo password
$router->get('/reestablecer', [AuthController::class, 'reestablecer']);
$router->post('/reestablecer', [AuthController::class, 'reestablecer']);
// Confirmación de Cuenta
$router->get('/mensaje', [AuthController::class, 'mensaje']);
$router->get('/confirmar-cuenta', [AuthController::class, 'confirmar']);
//Dashboard
$router->get('/admin/dashboard', [DashboardController::class, 'index']);
//Ventas
$router->get('/admin/ventas', [CompraController::class, 'index']);
$router->get('/admin/detalle-venta', [CompraController::class, 'detalle']);
//CRUD usuarios
$router->get('/admin/usuarios', [UsuariosController::class, 'index']);
$router->post('/admin/usuarios/desactivar', [UsuariosController::class, 'desactivar']);
$router->post('/admin/usuarios/activar', [UsuariosController::class, 'activar']);
$router->get('/admin/usuarios/correo', [UsuariosController::class, 'enviarCorreo']);
$router->post('/admin/usuarios/correo', [UsuariosController::class, 'enviarCorreo']);
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
//CRUD Blogs
$router->get('/admin/blogs', [BlogsController::class, 'index']);
$router->get('/admin/blogs/crear', [BlogsController::class, 'crear']);
$router->post('/admin/blogs/crear', [BlogsController::class, 'crear']);
$router->get('/admin/blogs/editar', [BlogsController::class, 'editar']);
$router->post('/admin/blogs/editar', [BlogsController::class, 'editar']);
$router->post('/admin/blogs/eliminar', [BlogsController::class, 'eliminar']);
//CRUD Tallas
$router->get('/admin/tallas', [TallasController::class, 'index']);
$router->get('/admin/tallas/crear', [TallasController::class, 'crear']);
$router->post('/admin/tallas/crear', [TallasController::class, 'crear']);
$router->get('/admin/tallas/editar', [TallasController::class, 'editar']);
$router->post('/admin/tallas/editar', [TallasController::class, 'editar']);
$router->post('/admin/tallas/eliminar', [TallasController::class, 'eliminar']);
//APIS
$router->get('/api/categorias-total', [APICategorias::class, 'index']);
$router->get('/api/buscar-producto', [APIProductos::class, 'buscarProducto']);
$router->get('/api/ventas', [APIVentas::class, 'index']);
$router->post('/api/guardar-compra', [APIPaypal::class, 'guardarCompra']);
//Reportes
$router->get('/reporte', [ReportesController::class, 'index']);


$router->comprobarRutas();
