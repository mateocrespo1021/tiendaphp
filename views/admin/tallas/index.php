<h2 class="dashboard__heading"><?php echo $titulo; ?></h2>

<div class="dashboard__contenedor-boton">
    <a class="dashboard__boton" href="/admin/tallas/crear?id=<?php echo $producto->id;?>">
        <i class="fa-solid fa-circle-plus"></i>
        Añadir Talla
    </a>
</div>

<div class="dashboard__contenedor">

<?php if (!empty($tallas)) { ?>
<table class="table">
    <thead class="table__thead">
      <tr>
        <th scope="col" class="table__th">Nombre</th>
        <th scope="col" class="table__th">Stock</th>
        <th scope="col" class="table__th"></th>
      </tr>
    </thead>
    <tbody class="table__tbody">
   <?php foreach ($tallas as $talla) { ?>
     <tr class="table__tr">
        <td class="table__td"><?php echo $talla->nombre; ?></td>
        <td class="table__td"><?php echo $talla->stock; ?></td>

        <td class="table__td--acciones">
            <a class="table__accion table__accion--editar" href="/admin/tallas/editar?id=<?php echo $talla->id; ?>" >
         <i class="fa-solid fa-user-pen"></i>
         Editar
        </a>

        <form action="/admin/tallas/eliminar" method="post" class="table__formulario">
           <input type="hidden" name="id" value="<?php echo $talla->id; ?>" >
            <button class="table__accion table__accion--eliminar" type="submit">
                <i class="fa-solid fa-circle-xmark"></i>
                Eliminar
            </button>
        </form>
        </td>
     </tr>
   <?php
  }?>
    </tbody>
</table>
<?php
}
else { ?>
<p class="text-center">No Hay Tallas Aún</p>
<?php
}?>

</div>
