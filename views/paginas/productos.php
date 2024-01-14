<div class="filtros">
    <form class="formulario filtros__formulario" id="form-buscador" method="post">
        <div class="filtros__contenido">
            <div class="formulario__campo">
                <label for="nombre" class="formulario__label">Nombre</label>
                <input type="text" class="formulario__input" id="nombre" name="nombre" placeholder="Nombre Producto">
            </div>


            <div id="price-search" class="formulario__campo">
                <label for="price-range" class="formulario__label">Precio <span id="selected-price">0</span></label>
                <input class="formulario__input" name="precio" type="range" id="price-range" min="0" max="1000" step="1"
                    value="0">
            </div>

            <div class="formulario__campo">
                <label for="categoria" class="formulario__label">Categorias</label>
                <select name="categoria_id" id="categoria" class="formulario__select">
                    <option value="">-- Seleccionar --</option>
                    <?php foreach ($categorias as $categoria) { ?>
                        <option value="<?php echo $categoria->id; ?>">
                            <?php echo $categoria->nombre; ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <input type="submit" class="formulario__submit filtros__submit" value="Filtrar">
    </form>
</div>


<main class="productos">
    <?php if (!empty($productos)) { ?>
        <?php foreach ($productos as $producto):
            ; ?>
            <div class="articulo">
                <div class="articulo__imagen">
                    <picture>
                        <source srcset="<?php echo $_ENV["HOST"] . "/img/productos/" . $producto->portada; ?>.webp"
                            type="image/webp">

                        <source srcset="<?php echo $_ENV["HOST"] . "/img/productos/" . $producto->portada; ?>.png"
                            type="image/png">

                        <img loading="lazy" decoding="async"
                            src="<?php echo $_ENV["HOST"] . "/img/productos/" . $producto->portada; ?>.png"
                            alt="imagen portada actual">
                    </picture>
                </div>
                <div class="articulo__contenido">
                    <p>
                        <?php echo $producto->nombre; ?>
                    </p>
                    <p>
                        <?php echo $producto->precio; ?>
                    </p>
                    <a href="/ver-producto?id=<?php echo $producto->id; ?>">Ver Más</a>
                </div>
            </div>
        <?php endforeach; ?>
    <?php } else {
        ; ?>
        <h3 class="productos-sin">Sin resultados</h3>
    <?php }
    ; ?>
</main>



<script>
    document.addEventListener('DOMContentLoaded', function () {
        const priceRange = document.getElementById('price-range');
        const selectedPrice = document.getElementById('selected-price');

        priceRange.addEventListener('input', function () {
            selectedPrice.textContent = priceRange.value;
        });
    });
</script>