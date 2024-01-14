<article class="blog">
    <h1 class="blog__h1">
        <?php echo $blog->titulo; ?>
    </h1>
    <div class="blog__img">
        <picture>
            <source srcset="<?php echo $_ENV["HOST"] . "/img/blog/" . $blog->imagen; ?>.webp" type="image/webp">

            <source srcset="<?php echo $_ENV["HOST"] . "/img/blog/" . $blog->imagen; ?>.png" type="image/png">

            <img loading="lazy" decoding="async" src="<?php echo $_ENV["HOST"] . "/img/blog/" . $blog->imagen; ?>.png"
                alt="imagen portada actual">
        </picture>
    </div>
    <div class="blog__contenido">
        <p>
            <?php echo $blog->fecha_publicacion; ?>
        </p>

        <?php echo $blog->contenido; ?>
    </div>
</article>