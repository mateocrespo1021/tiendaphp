<fieldset class="formulario__fieldset">
    <div class="formulario__campo">
        <label for="nombre" class="formulario__label">Nombre Producto</label>
        <input type="text" class="formulario__input" id="nombre" name="nombre" placeholder="Nombre Producto" value="<?php echo $producto->nombre ?? ""; ?>">
    </div>

    <div class="formulario__campo">
        <label for="precio" class="formulario__label">Precio Producto</label>
        <input type="number" step="0.01" class="formulario__input" id="precio" name="precio" placeholder="Precio Producto" value="<?php echo $producto->precio ?? ""; ?>">
    </div>

    <div class="formulario__campo">
        <label for="categoria" class="formulario__label">Categoria del Producto</label>
        <select name="categoria_id" id="categoria" class="formulario__select">
            <option value="">-- Seleccionar --</option>
            <?php foreach ($categorias as $categoria) { ?>
                <option <?php echo ($producto->categoria_id === $categoria->id) ? "selected" : ""; ?> value="<?php echo $categoria->id; ?>"><?php echo $categoria->nombre; ?></option>
            <?php } ?>
        </select>
    </div>
    <div class="formulario__campo">
        <label for="imagen" class="formulario__label">Imagen</label>
        <input type="file" class="formulario__input formulario__input--file" id="imagen" name="portada" placeholder="Imagen Producto" value="<?php echo $producto->portada ?? ""; ?>">
    </div>

    <?php if (isset($producto->portada_actual)) { ?>
        <p class="formulario__texto">Imagen Actual</p>
        <div class="formulario__imagen">
            <picture>
                <source srcset="<?php echo $_ENV["HOST"] . "/img/productos/" . $producto->portada; ?>.webp" type="image/webp">

                <source srcset="<?php echo $_ENV["HOST"] . "/img/productos/" . $producto->portada; ?>.png" type="image/png">

                <img loading="lazy" decoding="async" src="<?php echo $_ENV["HOST"] . "/img/productos/" . $producto->portada; ?>.png" alt="imagen portada actual">
            </picture>

        </div>
    <?php
    } ?>
</fieldset>
<fieldset class="formulario__fieldset">
    <legend>Información Extra</legend>
    <div class="formulario__campo">
        <label for="descripcion" class="formulario__label">Descripción</label>
        <textarea class="formulario__input" id="descripcion" name="descripcion" placeholder="Descripción Producto" cols="30" rows="10"><?php echo $producto->descripcion ?? ""; ?></textarea>
    </div>
</fieldset>