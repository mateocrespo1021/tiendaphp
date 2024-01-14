import { addCookie, getCookie, mostrarTotal, recargarPagar } from "./funciones.js";
(function (window, document) {
  document.addEventListener("DOMContentLoaded", () => {
    let pedidos = JSON.parse(getCookie("pedidos")) || [];
    const divCarrito = document.querySelector("#productos-carrito");
    const contentPagar = document.querySelector("#contenedor-pagar");
    const divVacio = document.querySelector("#div-vacio");
    if (divCarrito) {
      verificarVacio();
      mostrarHTML();
      mostrarTotal("det_subtotal_checkout");
      mostrarTotal("det_total_checkout");
    }

    function agregarEliminar() {
      const btnsEliminar = document.querySelectorAll(".btns-eliminar");
      btnsEliminar.forEach((btns) => {
        btns.addEventListener("click", eliminarProducto);
      });
    }

    function verificarVacio() {
      if (!pedidos.length > 0) {
        contentPagar.classList.add("ocultar");
        divVacio.classList.add("mostrar");
        return;
      } else {
        if (contentPagar.classList.contains("ocultar")) {
          contentPagar.classList.remove("ocultar");
        }
      }
    }

    function eliminarProducto(e) {
      pedidos = JSON.parse(getCookie("pedidos")) || [];
      let id;
      let talla;
      if (e.target.classList.contains("fa-circle-xmark")) {
        id = e.target.parentElement.getAttribute("data-id");
        talla = e.target.parentElement.getAttribute("data-talla");
      } else {
        id = e.target.getAttribute("data-id");
        talla = e.target.getAttribute("data-talla");
      }
      pedidos = pedidos.filter(
        (pedido) => !(pedido.id === id && pedido.talla === talla)
      );

      addCookie("pedidos", JSON.stringify(pedidos), 1);
      verificarVacio();
      mostrarHTML();
      mostrarTotal("det_subtotal_checkout");
      mostrarTotal("det_total_checkout");
      recargarPagar();
    }

    function mostrarHTML() {
      pedidos = JSON.parse(getCookie("pedidos")) || [];
      limpiarCarrito();
      pedidos.forEach((pedido) => {
        const { id, talla, cantidad, nombre, portada, precio } = pedido;
        const div = document.createElement("div");
        div.classList.add("carrito__pedido");
        div.innerHTML = `
                 <div class="carrito__general">
                 <img src="${portada}">
                 <p>Nombre: ${nombre}</p>
                 <p>Precio: ${precio}</p>
                 </div>
                 <div class="carrito__detalle">
                 <p class="talla-producto">Talla: ${talla}</p>
                 <p class="cantidad-producto">Cantidad: ${cantidad}</p>
                 </div>
                 <div class="carrito__botones">
                 <a href="ver-producto?id=${id}"><i class="fa-solid fa-user-pen"></i></a>
                 <a class="btns-eliminar" data-id="${id}" data-talla="${talla}"><i class="fa-solid fa-circle-xmark"></i></a>
                 </div>
                `;

        divCarrito.append(div);
      });
      agregarEliminar();
    }

    function limpiarCarrito() {
      while (divCarrito.firstChild) {
        divCarrito.removeChild(divCarrito.firstChild);
      }
    }
  });
})(window, document);
