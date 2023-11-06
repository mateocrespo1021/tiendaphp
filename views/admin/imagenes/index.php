<h2 class="dashboard__heading">
  <?php echo $titulo . $producto->nombre; ?>
</h2>

<div class="dashboard__contenedor-boton">
    <a class="dashboard__boton " href="/admin/productos">
        <i class="fa-solid fa-circle-arrow-left"></i>
        Volver
    </a>
    <a class="dashboard__boton" href="/admin/imagenes/crear?id=<?php echo $producto->id; ?>">
    <i class="fa-solid fa-circle-plus"></i>
    Añadir Imagen
  </a>
</div>



<div class="dashboard__contenedor">

  <?php if (!empty($imagenes)) { ?>
    <table class="table">
      <thead class="table__thead">
        <tr>
          <th scope="col" class="table__th">Imagen</th>
          <th scope="col" class="table__th"></th>
        </tr>
      </thead>
      <tbody class="table__tbody">
        <?php foreach ($imagenes as $imagen) { ?>
          <tr class="table__tr">
            <td class="table__td">
              <picture>
                <source srcset="<?php echo $_ENV["HOST"] . "/img/productos/" . $imagen->imagen; ?>.webp" type="image/webp">

                <source srcset="<?php echo $_ENV["HOST"] . "/img/productos/" . $imagen->imagen; ?>.png" type="image/png">

                <img loading="lazy" decoding="async"
                  src="<?php echo $_ENV["HOST"] . "/img/productos/" . $imagen->imagen; ?>.png" alt="imagen portada actual">
              </picture>
            </td>
            <td class="table__td--acciones">
              <a class="table__accion table__accion--editar"
                href="/admin/imagenes/editar?id=<?php echo $imagen->id; ?>">
                <i class="fa-solid fa-user-pen"></i>
                Editar
              </a>
              <form action="/admin/imagenes/eliminar" method="post" class="table__formulario">
                <input type="hidden" name="id" value="<?php echo $imagen->id; ?>">
                <button class="table__accion table__accion--eliminar" type="submit">
                  <i class="fa-solid fa-circle-xmark"></i>
                  Eliminar
                </button>
              </form>
            </td>
          </tr>
          <?php
        } ?>
      </tbody>
    </table>
    <?php
  } else { ?>
    <p class="text-center">No Hay Imagenes Aún</p>
    <?php
  } ?>

</div>

