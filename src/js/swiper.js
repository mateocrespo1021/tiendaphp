import Swiper, { Navigation } from "swiper";
import "swiper/css"
import "swiper/css/navigation"

document.addEventListener("DOMContentLoaded", () => {
    if (document.querySelector(".swiper")) {
        const opciones = {
            slidesPerView: 1,
            spaceBetween: 5,
            direction: 'vertical',
            loop: true,
            freeMode: true,
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev"
            },
            autoplay: {
                delay: 3000, // Tiempo en milisegundos entre cada transición
                disableOnInteraction: false, // Permitir que el autoplay continúe después de interactuar con el carrusel
              },
        }
        Swiper.use([Navigation])
        new Swiper(".swiper", opciones)
    }
})
