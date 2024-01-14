<h2 class="dashboard__heading"><?php echo $titulo; ?></h2>

<div class="dashboard__contenedor-boton">
    <a class="dashboard__boton" href="/admin/categorias">
        <i class="fa-solid fa-circle-arrow-left"></i>
        Volver
    </a>
</div>

<div class="dashboard__formulario">

<?php require_once(__DIR__ . '/../../templates/alertas.php'); ?>

    <form action="/admin/categorias/crear" method="post" class="formulario">
         <?php include_once __DIR__ . "/formulario.php"; ?>

         <input class="formulario__submit formulario__submit--registrar" type="submit" value="Añadir Categoria">
    </form>
</div>