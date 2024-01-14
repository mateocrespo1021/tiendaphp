<?php
session_start();
?>

<header class="header">
    <div class="header__contenedor">
        <div class="header__buscador">
            <div class="iconos">
                <a href="<?php echo isset($_SESSION['nombre']) ? '/historial?id=' . $_SESSION['id'] : '/login'; ?>"
                    class="iconos__login">
                    <i class="fa-solid fa-user"></i>
                    <p>
                        <?php
                        echo $_SESSION['nombre'] ?? 'Iniciar Sesion';
                        ?>
                    </p>
                </a>
                <?php
                if (isset($_SESSION['nombre'])) {
                    ?>
                    <form action="/logout" method="POST">
                        <button type="submit">
                            <picture>
                                <source srcset="<?php echo $_ENV["HOST"] . "/build/img/cerrar-sesion.webp"; ?>"
                                    type="image/webp">
                                <source srcset="<?php echo $_ENV["HOST"] . "/build/img/cerrar-sesion.avif"; ?>"
                                    type="image/avif">
                                <img class="speaker__imagen" width="50px" height="50px" loading="lazy" decoding="async"
                                    src="<?php echo $_ENV["HOST"] . "/build/img/cerrar-sesion.jpg"; ?>"
                                    alt="imagen ponente actual">
                            </picture>
                        </button>
                    </form>
                    <?php
                }
                ?>

            </div>
            <div class="carrito">
                <!-- Trigger/Open The Modal -->
                <button id="mostrarModalBtn" class="iconos__store">
                <i class="fas fa-shopping-cart"></i>
                </button>
            </div>
        </div>

        <div class="header__nav">
            <h1 class="header__h1"><a href="/">Vida Etc.</a></h1>
            <div id="menu" class="header__hambur">
                <i class="fa-solid fa-bars"></i>
            </div>
            <nav id="nav" class="header__nav">
                <ul class="header__lista">
                    <li><a href="/productos">Tienda</a></li>
                    <li><a href="/acerca">Acerca de</a></li>
                    <li><a href="/blogs">Blog</a></li>
                    <li><a href="/contacto">Contacto</a></li>
                </ul>
            </nav>
        </div>
    </div>

</header>