<div class="blogs">
    <div class="blogs__img">
        <picture>
            <source srcset="<?php echo $_ENV["HOST"] . "/build/img/slider1.webp"; ?>" type="image/webp">
            <source srcset="<?php echo $_ENV["HOST"] . "/build/img/slider1.avif"; ?>" type="image/avif">
            <img class="speaker__imagen" width="200" height="300" loading="lazy" decoding="async"
                src="<?php echo $_ENV["HOST"] . "/build/img/slider1.jpg"; ?>" alt="imagen ponente actual">
        </picture>
    </div>
    <div class="entradas">
        <?php foreach ($blogs as $blog) { ?>
            <article class="entrada" <?php aos_animacion(); ?>>
                <div class="entrada__img">
                    <picture>
                        <source srcset="<?php echo $_ENV["HOST"] . "/img/blog/" . $blog->imagen; ?>.webp" type="image/webp">

                        <source srcset="<?php echo $_ENV["HOST"] . "/img/blog/" . $blog->imagen; ?>.png" type="image/png">

                        <img loading="lazy" decoding="async"
                            src="<?php echo $_ENV["HOST"] . "/img/blog/" . $blog->imagen; ?>.png"
                            alt="imagen portada actual">
                    </picture>
                </div>
                <div class="entrada__contenido">
                    <p>
                        <?php echo $blog->fecha_publicacion; ?>
                    </p>
                    <h3>
                        <?php echo $blog->titulo; ?>
                    </h3>
                    <p class="entrada__p">
                        <?php echo strip_tags($blog->contenido); ?>
                    </p>
                    <ul class="entrada__ul">
                        <?php
                        $etiquetas = explode(",", $blog->etiquetas);
                        foreach ($etiquetas as $etiqueta) {
                            ; ?>
                        <li class="entrada__categoria">
                            <?php echo $etiqueta; ?>
                        </li>
                    <?php }
                        ; ?>
                    </ul>

                    <div class="entrada__div">
                        <p>
                            Autor :
                            <?php echo $blog->autor; ?>
                        </p>
                        <a href="/blog?id=<?php echo $blog->id; ?>">Ver Blog <i class="fa-solid fa-newspaper"></i></a>
                    </div>
                </div>
            </article>
        <?php } ?>
    </div>
</div>