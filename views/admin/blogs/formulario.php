<fieldset class="formulario__fieldset">
    <div class="formulario__campo">
        <label for="titulo" class="formulario__label">Titulo Blog</label>
        <input type="text" class="formulario__input" id="titulo" name="titulo" placeholder="Titulo Blog"
            value="<?php echo $blog->titulo ?? ""; ?>">
    </div>

    <div class="formulario__campo">
        <label for="autor" class="formulario__label">Autor</label>
        <input type="text" class="formulario__input" id="autor" name="autor" placeholder="Autor Blog"
            value="<?php echo $blog->autor ?? ""; ?>">
    </div>

    <div class="formulario__campo">
        <label for="miTextarea" class="formulario__label">Contenido del Blog</label>
        <script>
            tinymce.init({
                selector: 'textarea',
                plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
                toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
            });
        </script>
        <textarea id="miTextarea" name="contenido"><?php echo $blog->contenido ?? ""; ?></textarea>
    </div>
    <div class="formulario__campo">
        <label for="etiquetas_input" class="formulario__label">Etiquetas Blog (separadas por coma)</label>
        <input type="text" class="formulario__input" id="etiquetas_input"
            placeholder="Ej. Moda , Pantalones , Camisas ">
    </div>
    <div id="etiquetas" class="formulario__listado"></div>
    <input type="hidden" name="etiquetas" value="<?php echo $blog->etiquetas ?? ""; ?>">

    <div class="formulario__campo">
        <label for="imagen" class="formulario__label">Imagen</label>
        <input type="file" class="formulario__input formulario__input--file" id="imagen" name="imagen"
            placeholder="Portada Blog" value="<?php echo $blog->imagen ?? ""; ?>">
    </div>
    <?php if (isset($blog->imagen_actual)) { ?>
        <p class="formulario__texto">Imagen Actual</p>
        <div class="formulario__imagen">
            <picture>
                <source srcset="<?php echo $_ENV["HOST"] . "/img/blog/" . $blog->imagen; ?>.webp" type="image/webp">

                <source srcset="<?php echo $_ENV["HOST"] . "/img/blog/" . $blog->imagen; ?>.png" type="image/png">

                <img loading="lazy" decoding="async" src="<?php echo $_ENV["HOST"] . "/img/blog/" . $blog->imagen; ?>.png"
                    alt="imagen portada actual">
            </picture>

        </div>
        <?php
    } ?>
</fieldset>