<main class="productos">
    <?php foreach ($productos as $producto) :; ?>
        <div class="articulo">
            <div class="articulo__imagen">
                <picture>
                    <source srcset="<?php echo $_ENV["HOST"] . "/img/productos/" . $producto->portada; ?>.webp" type="image/webp">

                    <source srcset="<?php echo $_ENV["HOST"] . "/img/productos/" . $producto->portada; ?>.png" type="image/png">

                    <img loading="lazy" decoding="async" src="<?php echo $_ENV["HOST"] . "/img/productos/" . $producto->portada; ?>.png" alt="imagen portada actual">
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
</main>