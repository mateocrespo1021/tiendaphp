import { addCookie, getCookie, mostrarTotal } from "./funciones.js";
(function (window, document) {
  document.addEventListener("DOMContentLoaded", () => {
    let pedidos = JSON.parse(getCookie("pedidos")) || [];
    const divCarrito = document.querySelector("#productos-carrito");
    const paypal = document.querySelector("#paypal-button-container");
    if (divCarrito) {
      mostrarTotal()
      if (!pedidos.length > 0) {
        paypal.classList.add("ocultar");
        return;
      }

      paypal.classList.remove("ocultar")
      mostrarHTML();

    }

    const btnsEliminar = document.querySelectorAll(".btns-eliminar");
    btnsEliminar.forEach((btns) => {
      btns.addEventListener("click", eliminarProducto);
    });

    function eliminarProducto(e) {
      let id;
      let talla
      if (e.target.classList.contains("fa-circle-xmark")) {
        id = e.target.parentElement.getAttribute("data-id");
        talla = e.target.parentElement.getAttribute("data-talla");
      } else {
        id = e.target.getAttribute("data-id");
        talla = e.target.getAttribute("data-talla");
      }



      pedidos = pedidos.filter((pedido) => !(pedido.id === id && pedido.talla === talla));

      addCookie("pedidos", JSON.stringify(pedidos), 1);
      mostrarHTML();
      mostrarTotal()
      if (!pedidos.length > 0) {
        paypal.classList.add("ocultar");
      }
    }

    function mostrarHTML() {
      limpiarCarrito();
      pedidos.forEach((pedido) => {
        const { id, talla, cantidad, nombre, portada, precio } = pedido;
        const div = document.createElement("div");
        div.classList.add("carrito__pedido");
        div.innerHTML = `
                 <div class="carrito__general">
                 <img src="../../img/productos/${portada}.webp">
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
    }

    function limpiarCarrito() {
      while (divCarrito.firstChild) {
        divCarrito.removeChild(divCarrito.firstChild);
      }
    }
  });
})(window, document);
