<aside class="dashboard__sidebar">
  <nav class="dashboard__menu">
     <a href="/admin/dashboard" class="dashboard__enlace <?php echo paginaActual("/dashboard") ? "dashboard__enlace--actual":""; ?>">
     <i class="fa-solid fa-house dashboard__icono"></i>
     <span class="dashboard__menu--texto ">
        Inicio
     </span> 
     </a>  
     <a href="/admin/productos" class="dashboard__enlace <?php echo paginaActual("/productos") ? "dashboard__enlace--actual":""; ?>">
     <i class="fa-solid fa-microphone dashboard__icono"></i>
     <span class="dashboard__menu--texto">
        Productos
     </span> 
     </a>     
     <a href="/admin/eventos" class="dashboard__enlace <?php echo paginaActual("/imagenes") ? "dashboard__enlace--actual":""; ?>">
     <i class="fa-solid fa-calendar dashboard__icono"></i>
     <span class="dashboard__menu--texto">
        Imagenes
     </span> 
     </a> 
     <a href="/admin/registrados" class="dashboard__enlace <?php echo paginaActual("/registrados") ? "dashboard__enlace--actual":""; ?>">
     <i class="fa-solid fa-users dashboard__icono"></i>
     <span class="dashboard__menu--texto">
       Registrados
     </span> 
     </a> 
     <a href="/admin/categorias" class="dashboard__enlace <?php echo paginaActual("/categorias") ? "dashboard__enlace--actual":""; ?>">
     <i class="fa-solid fa-users dashboard__icono"></i>
     <span class="dashboard__menu--texto">
       Categorias
     </span> 
     </a>      
         
    
  </nav>
</aside>