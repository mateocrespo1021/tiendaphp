<section class="contenedor-swiper">

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
    <div class="articulo">
      <div class="articulo__imagen">
        <picture>
          <source srcset="<?php echo $_ENV["HOST"] . "/build/img/slider3.webp"; ?>" type="image/webp">
          <source srcset="<?php echo $_ENV["HOST"] . "/build/img/slider3.avif"; ?>" type="image/avif">
          <img class="speaker__imagen" width="200" height="300" loading="lazy" decoding="async"
            src="<?php echo $_ENV["HOST"] . "/build/img/slider3.jpg"; ?>" alt="imagen ponente actual">
        </picture>
      </div>
       <div class="articulo__contenido">
         <p>Pantalones Lola</p>
         <p>85$</p>
       </div>
    </div>
    <div class="articulo">
      <div class="articulo__imagen">
        <picture>
          <source srcset="<?php echo $_ENV["HOST"] . "/build/img/slider3.webp"; ?>" type="image/webp">
          <source srcset="<?php echo $_ENV["HOST"] . "/build/img/slider3.avif"; ?>" type="image/avif">
          <img class="speaker__imagen" width="200" height="300" loading="lazy" decoding="async"
            src="<?php echo $_ENV["HOST"] . "/build/img/slider3.jpg"; ?>" alt="imagen ponente actual">
        </picture>
      </div>
       <div class="articulo__contenido">
         <p>Pantalones Lola</p>
         <p>85$</p>
       </div>
    </div>
    <div class="articulo">
      <div class="articulo__imagen">
        <picture>
          <source srcset="<?php echo $_ENV["HOST"] . "/build/img/slider3.webp"; ?>" type="image/webp">
          <source srcset="<?php echo $_ENV["HOST"] . "/build/img/slider3.avif"; ?>" type="image/avif">
          <img class="speaker__imagen" width="200" height="300" loading="lazy" decoding="async"
            src="<?php echo $_ENV["HOST"] . "/build/img/slider3.jpg"; ?>" alt="imagen ponente actual">
        </picture>
      </div>
       <div class="articulo__contenido">
         <p>Pantalones Lola</p>
         <p>85$</p>
       </div>
    </div>
   
  </div>
  <button class="articulos__btn">Ver Todo</button>
</main>