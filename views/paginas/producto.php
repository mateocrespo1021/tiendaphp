<div class="producto">
    <div class="producto__contenido">
        <!-- Slider main container -->
        <div class="swiper">
            <!-- Additional required wrapper -->
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <picture>
                        <source srcset="<?php echo $_ENV["HOST"] . "/img/productos/" . $producto->portada; ?>.webp"
                            type="image/webp">

                        <source srcset="<?php echo $_ENV["HOST"] . "/img/productos/" . $producto->portada; ?>.png"
                            type="image/png">

                        <img class="producto__imagen" loading="lazy" decoding="async"
                            src="<?php echo $_ENV["HOST"] . "/img/productos/" . $producto->portada; ?>.png"
                            alt="imagen portada actual">
                    </picture>
                </div>
                <?php foreach ($imagenes as $imagen):
                    ; ?>
                    <!-- Slides -->
                    <div class="swiper-slide">
                        <picture>
                            <source srcset="<?php echo $_ENV["HOST"] . "/img/productos/" . $imagen->imagen; ?>.webp"
                                type="image/webp">

                            <source srcset="<?php echo $_ENV["HOST"] . "/img/productos/" . $imagen->imagen; ?>.png"
                                type="image/png">

                            <img loading="lazy" decoding="async"
                                src="<?php echo $_ENV["HOST"] . "/img/productos/" . $imagen->imagen; ?>.png"
                                alt="imagen portada actual">
                        </picture>
                    </div>
                <?php endforeach; ?>
            </div>
            <!-- If we need pagination -->
            <div class="swiper-pagination"></div>

            <!-- If we need navigation buttons -->
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>

            <!-- If we need scrollbar -->
            <div class="swiper-scrollbar"></div>
        </div>

        <div class="producto__info">
            <div>
                <p class="producto__nombre">
                    <?php echo $producto->nombre; ?>
                </p>
                <p class="producto__precio">
                    <?php echo $producto->precio . " $"; ?>
                </p>
                <p>
                    <?php echo $producto->descripcion; ?>
                </p>
            </div>
            <form action="" class="formulario">
                <fieldset class="formulario__fieldset">
                    <div class="formulario__campo">
                        <label class="formulario__label" for="talla">Talla</label>
                        <select class="formulario__input" name="talla" id="talla">
                            <option value="">-- Seleccione --</option>
                            <?php foreach ($tallas as $talla):
                                ; ?>
                                <option value="<?php echo $talla->nombre; ?>">
                                    <?php echo $talla->nombre; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="formulario__campo">
                        <label class="formulario__label" for="cantidad">Cantidad</label>
                        <input min="1" class="formulario__input" type="number" id="cantidad" placeholder="Ej. 1,2">
                    </div>
                </fieldset>
                <button id="btn-carrito" class="formulario__submit formulario__submit--agregar">Agregar al
                    Carrito</button>
            </form>
        </div>
    </div>
</div>