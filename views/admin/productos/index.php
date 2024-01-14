<h2 class="dashboard__heading">
    <?php echo $titulo; ?>
</h2>

<div class="dashboard__contenedor-boton">
    <a id="btn-productos" class="dashboard__boton" href="/admin/productos/crear">
        <i class="fa-solid fa-circle-plus"></i>
        Añadir Productos
    </a>
</div>

<div class="dashboard__contenedor">

    <?php if (!empty($productos)) { ?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">Nombre</th>
                    <th scope="col" class="table__th">Precio</th>
                    <th scope="col" class="table__th">Categoria</th>
                    <th scope="col" class="table__th">Portada</th>
                    <th scope="col" class="table__th">Descripcion</th>
                    <th scope="col" class="table__th"></th>
                </tr>
            </thead>
            <tbody class="table__tbody">
                <?php foreach ($productos as $producto) { ?>
                    <tr class="table__tr">
                        <td class="table__td">
                            <?php echo $producto->nombre; ?>
                        </td>
                        <td class="table__td">
                            <?php echo $producto->precio; ?>
                        </td>
                        <td class="table__td">
                            <?php echo $producto->categoria->nombre; ?>
                        </td>
                        <td class="table__td">
                            <picture>
                                <source srcset="<?php echo $_ENV["HOST"] . "/img/productos/" . $producto->portada; ?>.webp"
                                    type="image/webp">

                                <source srcset="<?php echo $_ENV["HOST"] . "/img/productos/" . $producto->portada; ?>.png"
                                    type="image/png">

                                <img loading="lazy" decoding="async"
                                    src="<?php echo $_ENV["HOST"] . "/img/productos/" . $producto->portada; ?>.png"
                                    alt="imagen portada actual">
                            </picture>
                        </td>
                        <td class="table__td">
                            <p class="table__parrafo">
                                <?php echo $producto->descripcion; ?>
                            </p>

                        </td>
                        <td class="table__td--acciones">
                            <a class="table__accion table__accion--editar"
                                href="/admin/imagenes?id=<?php echo $producto->id; ?>">
                                <i class="fa-solid fa-user-pen"></i>
                                Imagenes
                            </a>
                            <a class="table__accion table__accion--editar" href="/admin/tallas?id=<?php echo $producto->id; ?>">
                                <i class="fa-solid fa-user-pen"></i>
                                Tallas Y Stock
                            </a>
                            <a class="table__accion table__accion--editar"
                                href="/admin/productos/editar?id=<?php echo $producto->id; ?>">
                                <i class="fa-solid fa-user-pen"></i>
                                Editar
                            </a>

                            <form action="/admin/productos/eliminar" method="post" class="table__formulario">
                                <input type="hidden" name="id" value="<?php echo $producto->id; ?>">
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
        <p class="text-center">No Hay Productos Aún</p>
        <?php
    } ?>

</div>

<?php
echo $paginacion;
?>