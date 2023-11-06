<fieldset class="formulario__fieldset">
    <div class="formulario__campo">
        <label for="nombre" class="formulario__label">Nombre Categoria</label>
        <input type="text" class="formulario__input" id="nombre" name="nombre" placeholder="Nombre Categoria" value="<?php echo $categoria->nombre ?? "";?>">
    </div>
</fieldset>