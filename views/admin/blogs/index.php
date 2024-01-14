<h2 class="dashboard__heading">
    <?php echo $titulo; ?>
</h2>

<div class="dashboard__contenedor-boton">
    <a class="dashboard__boton" href="/admin/blogs/crear">
        <i class="fa-solid fa-circle-plus"></i>
        Crear blog
    </a>
</div>

<div class="dashboard__contenedor">

    <?php if (!empty($blogs)) { ?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">Titulo</th>
                    <th scope="col" class="table__th">Fecha publicado</th>
                    <th scope="col" class="table__th">Autor</th>
                    <th scope="col" class="table__th">Etiquetas</th>
                    <th scope="col" class="table__th">Portada</th>
                    <th scope="col" class="table__th"></th>
                </tr>
            </thead>
            <tbody class="table__tbody">
                <?php foreach ($blogs as $blog) { ?>
                    <tr class="table__tr">
                        <td class="table__td">
                            <?php echo $blog->titulo; ?>
                        </td>
                        <td class="table__td">
                            <?php echo $blog->fecha_publicacion; ?>
                        </td>
                        <td class="table__td">
                            <?php echo $blog->autor; ?>
                        </td>
                        <td class="table__td">
                            <?php echo $blog->etiquetas; ?>
                        </td>
                        <td class="table__td">
                            <picture>
                                <source srcset="<?php echo $_ENV["HOST"] . "/img/blog/" . $blog->imagen; ?>.webp"
                                    type="image/webp">

                                <source srcset="<?php echo $_ENV["HOST"] . "/img/blog/" . $blog->imagen; ?>.png"
                                    type="image/png">

                                <img loading="lazy" decoding="async"
                                    src="<?php echo $_ENV["HOST"] . "/img/blog/" . $blog->imagen; ?>.png"
                                    alt="imagen portada actual">
                            </picture>
                        </td>
                        <td class="table__td--acciones">
                            <a class="table__accion table__accion--editar"
                                href="/admin/blogs/editar?id=<?php echo $blog->id; ?>">
                                <i class="fa-solid fa-user-pen"></i>
                                Editar
                            </a>

                            <form action="/admin/blogs/eliminar" method="post" class="table__formulario">
                                <input type="hidden" name="id" value="<?php echo $blog->id; ?>">
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
        <p class="text-center">No Hay Blogs Aún</p>
        <?php
    } ?>

</div>

<?php
echo $paginacion;
?>