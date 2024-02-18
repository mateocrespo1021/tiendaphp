<section class="contenedor-swiper" <?php aos_animacion(); ?>>

  <h3 class="text-lineas">
    <?php echo $subtitulo; ?>
  </h3>

  <!-- Slider main container -->
  <div class="swiper">
    <!-- Additional required wrapper -->
    <div class="swiper-wrapper">
      <!-- Slides -->
      <div class="swiper-slide">
        <picture>
          <source srcset="<?php echo $_ENV["HOST"] . "/build/img/slider1.webp"; ?>" type="image/webp">
          <source srcset="<?php echo $_ENV["HOST"] . "/build/img/slider1.avif"; ?>" type="image/avif">
          <img class="speaker__imagen" width="200" height="300" loading="lazy" decoding="async"
            src="<?php echo $_ENV["HOST"] . "/build/img/slider1.jpg"; ?>" alt="imagen ponente actual">
        </picture>
      </div>
      <div class="swiper-slide">
        <picture>
          <source srcset="<?php echo $_ENV["HOST"] . "/build/img/slider2.webp"; ?>" type="image/webp">
          <source srcset="<?php echo $_ENV["HOST"] . "/build/img/slider2.avif"; ?>" type="image/avif">
          <img class="speaker__imagen" width="200" height="300" loading="lazy" decoding="async"
            src="<?php echo $_ENV["HOST"] . "/build/img/slider2.jpg"; ?>" alt="imagen ponente actual">
        </picture>
      </div>
      <div class="swiper-slide">
        <picture>
          <source srcset="<?php echo $_ENV["HOST"] . "/build/img/slider3.webp"; ?>" type="image/webp">
          <source srcset="<?php echo $_ENV["HOST"] . "/build/img/slider3.avif"; ?>" type="image/avif">
          <img class="speaker__imagen" width="200" height="300" loading="lazy" decoding="async"
            src="<?php echo $_ENV["HOST"] . "/build/img/slider3.jpg"; ?>" alt="imagen ponente actual">
        </picture>
      </div>

    </div>
    <!-- If we need pagination -->
    <div class="swiper-pagination"></div>

    <!-- If we need navigation buttons -->
    <div class="swiper-button-prev"></div>
    <div class="swiper-button-next"></div>

    <!-- If we need scrollbar -->
    <div class="swiper-scrollbar"></div>
  </div>
</section>

<main class="articulos">
  <h3 class="text-lineas">ARTÍCULOS DESTACADOS </h3>
  <div class="articulos__contenedor">
    <?php if (!empty($productos)) { ?>
      <?php foreach ($productos as $producto):
        ; ?>
        <div class="articulo" <?php aos_animacion(); ?>>
          <div class="articulo__imagen">
            <picture>
              <source srcset="<?php echo $_ENV["HOST"] . "/img/productos/" . $producto->portada; ?>.webp" type="image/webp">

              <source srcset="<?php echo $_ENV["HOST"] . "/img/productos/" . $producto->portada; ?>.png" type="image/png">

              <img loading="lazy" decoding="async"
                src="<?php echo $_ENV["HOST"] . "/img/productos/" . $producto->portada; ?>.png" alt="imagen portada actual">
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

  </div>
  <a class="articulos__btn" href="/productos">Ver Todo</a>
</main>

<section class="resumen">
      <h2 class="resumen__titulo">¿Comó nos definimos?</h2>
    <div class="resumen__grid">
        <div <?php aos_animacion(); ?> class="resumen__bloque">
            <p class="resumen__texto">Elegancia</p>
        </div>

        <div <?php aos_animacion(); ?> class="resumen__bloque">
            <p class="resumen__texto">Comodidad</p>
        </div>

        <div <?php aos_animacion(); ?> class="resumen__bloque">
            <p class="resumen__texto">Versatilidad</p>
        </div>

        <div <?php aos_animacion(); ?> class="resumen__bloque">
            <p class="resumen__texto">Tendencia</p>
        </div>
    </div>
</section>

<section class="contenedor">
<h2 <?php aos_animacion(); ?> class="mapa-titulo" >¿Dondé nos ubicamos?</h2>
  <div <?php aos_animacion(); ?>  id="mapa" class="mapa"></div>
</section>
