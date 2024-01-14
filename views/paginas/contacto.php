<section class="contacto" id="contacto">
    <?php
    require_once __DIR__ . '/../templates/alertas.php';
    ?>
    <h3>Contáctanos</h3>

    <div class="contacto__form">
        <form id="form-contacto" method="POST" class="formulario">
            <div class="formulario__campo">
                <label for="nombre" class="formulario__label">Nombres</label>
                <input type="text" class="formulario__input" placeholder="Tu Nombre" id="nombre" name="nombre" value="<?php echo $_POST["nombre"] ?? "" ;?>" >
            </div>

            <div class="formulario__campo">
                <label for="telefono" class="formulario__label">Telefono</label>
                <input type="tel" class="formulario__input" placeholder="Tu Telefono" id="telefono" name="telefono" value="<?php echo $_POST["telefono"] ?? "" ;?>"
                    >
            </div>
            <div class="formulario__campo">
                <label for="email" class="formulario__label">Email</label>
                <input type="email" class="formulario__input" placeholder="Tu Email" id="email" name="email" value="<?php echo $_POST["email"] ?? "";?>">
            </div>

            <div class="formulario__campo">
                <label for="asunto" class="formulario__label">Asunto</label>
                <input type="text" class="formulario__input" placeholder="Tu Asunto" id="asunto" name="asunto" value="<?php echo $_POST["asunto"] ?? "";?>">
            </div>
            <div class="formulario__campo">
                <label for="mensaje" class="formulario__label">Mensaje</label>
                <textarea name="mensaje" id="mensaje" class="formulario__input" cols="30" rows="10" ><?php echo $_POST["mensaje"] ?? "";?></textarea>
            </div>

            <input type="submit" class="formulario__submit contacto__boton" value="Enviar">
        </form>
    </div>
</section>