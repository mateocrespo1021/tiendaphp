<fieldset class="formulario__fieldset">
    <div class="formulario__campo">
        <label for="nombre" class="formulario__label">Talla</label>
        <input type="text" class="formulario__input" id="nombre" name="nombre" placeholder="Talla" value="<?php echo $talla->nombre ?? "";?>">
    </div>
    <div class="formulario__campo">
        <label for="stock" class="formulario__label">Stock</label>
        <input min="1" type="number" class="formulario__input" id="stock" name="stock" placeholder="Stock" value="<?php echo $talla->stock ?? "";?>">
    </div>
</fieldset>