<fieldset class="formulario__fieldset">
    <div class="formulario__campo">
        <label for="imagen" class="formulario__label">Imagen</label>
        <input type="file" class="formulario__input formulario__input--file" id="imagen" name="imagen"
            placeholder="Imagen Producto" value="<?php echo $imagen->imagen ?? ""; ?>">
    </div>
    <?php if (isset($imagen->imagen_actual)) { ?>
        <p class="formulario__texto">Imagen Actual</p>
        <div class="formulario__imagen">
            <picture>
                <source srcset="<?php echo $_ENV["HOST"] . "/img/productos/" . $imagen->imagen_actual; ?>.webp" type="image/webp">

                <source srcset="<?php echo $_ENV["HOST"] . "/img/productos/" . $imagen->imagen_actual; ?>.png" type="image/png">

                <img loading="lazy" decoding="async" src="<?php echo $_ENV["HOST"] . "/img/productos/" . $imagen->imagen_actual; ?>.png" alt="imagen portada actual">
            </picture>

        </div>
    <?php
    } ?>
</fieldset>