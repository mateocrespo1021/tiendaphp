<aside class="dashboard__sidebar">
  <nav class="dashboard__menu">
     <a href="/admin/dashboard" class="dashboard__enlace <?php echo paginaActual("/dashboard") ? "dashboard__enlace--actual":""; ?>">
     <i class="fa-solid fa-house dashboard__icono"></i>
     <span class="dashboard__menu--texto ">
        Inicio
     </span> 
     </a>  
     <a href="/admin/ventas" class="dashboard__enlace <?php echo paginaActual("/ventas") ? "dashboard__enlace--actual":""; ?>">
     <i class="fa-solid fa-shop"></i>
     <span class="dashboard__menu--texto">
        Ventas
     </span> 
     </a>     
     <a href="/admin/productos" class="dashboard__enlace <?php echo paginaActual("/productos") ? "dashboard__enlace--actual":""; ?>">
    <i class="fa-brands fa-dropbox"></i>
     <span class="dashboard__menu--texto">
        Productos
     </span> 
     </a>     
     <a href="/admin/categorias" class="dashboard__enlace <?php echo paginaActual("/categorias") ? "dashboard__enlace--actual":""; ?>">
     <i class="fa-solid fa-tag"></i>
     <span class="dashboard__menu--texto">
       Categorias Productos
     </span> 
     </a>     
     <a href="/admin/usuarios" class="dashboard__enlace <?php echo paginaActual("/usuarios") ? "dashboard__enlace--actual":""; ?>">
     <i class="fa-solid fa-users dashboard__icono"></i>
     <span class="dashboard__menu--texto">
       Usuarios
     </span> 
     </a>  
     <a href="/admin/blogs" class="dashboard__enlace <?php echo paginaActual("/blogs") ? "dashboard__enlace--actual":""; ?>">
     <i class="fa-solid fa-address-book"></i>
     <span class="dashboard__menu--texto">
        Blog
     </span> 
     </a> 
  </nav>
</aside>