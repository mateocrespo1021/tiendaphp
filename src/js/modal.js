import { addCookie, getCookie, mostrarTotal, recargarPagar } from "./funciones.js";

document.addEventListener("DOMContentLoaded", function () {
  // Get the button that opens the modal
  const btn = document.getElementById("mostrarModalBtn");

  btn.addEventListener("click", generarModal);

  function generarModal() {
    // Genera el contenido del modal dinámicamente
    const modalHTML = document.createElement("div");
    modalHTML.classList.add("modal");
    modalHTML.id = "myModal";

    const modalContent = generarCarrito();

    modalHTML.appendChild(modalContent);

    // Agrega el modal al final del cuerpo del documento
    btn.after(modalHTML);

    generarBtnPago()


    const btnsEliminar = document.querySelectorAll(".btns-eliminar");
    btnsEliminar.forEach((btns) => {
      btns.addEventListener("click", eliminarProducto);
    });

    setTimeout(() => {
      const modalContenido = document.querySelector(".modal-content");
      modalContenido.classList.add("animar");
    }, 0);

    // Obtén la referencia al modal después de haberlo insertado en el DOM
    const modal = document.getElementById("myModal");

    // Get the <span> element that closes the modal
    const span = document.getElementsByClassName("close")[0];

    // When the user clicks on <span> (x), close the modal
    span.onclick = function () {
      const modalContenido = document.querySelector(".modal-content");
      modalContenido.classList.add("cerrar");
      setTimeout(() => {
        modal.remove();
      }, 500);
    };

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function (event) {
      if (event.target == modal) {
        const modalContenido = document.querySelector(".modal-content");
        modalContenido.classList.add("cerrar");
        setTimeout(() => {
          modal.remove();
          recargarPagar()
        }, 500);
      }
    };
  }

  function generarCarrito() {
    let pedidos = JSON.parse(getCookie("pedidos")) || [];

    //Si existe el modal entonces solo limpio y acutalizo la informacion
    if (document.querySelector(".modal-content")) {
      //Si ya existe el modal
      limpiarCarrito();
      const span = document.createElement("span");
      span.classList.add("close");
      span.innerHTML = '<i class="fa-solid fa-circle-xmark"></i>';
      document.querySelector(".modal-content").appendChild(span);
      //Verifico que este vacio el carrito de pedidos entonces imprimo un mensaje
      if (!pedidos.length) {
        const mensaje = document.createElement("div");
        mensaje.textContent = "No tiene productos en el carrito";
        mensaje.classList.add("carrito__vacio");
        document.querySelector(".modal-content").appendChild(mensaje);
        return;
      }
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
        document.querySelector(".modal-content").append(div);
      });

      //Agrego el boton de pagar en el carrito

     generarBtnPago()

      const btnsEliminar = document.querySelectorAll(".btns-eliminar");
      btnsEliminar.forEach((btns) => {
        btns.addEventListener("click", eliminarProducto);
      });

      return;
    }

    //Si no existe el modal

    const modalContent = document.createElement("div");
    modalContent.classList.add("modal-content");
    const span = document.createElement("span");
    span.classList.add("close");
    span.innerHTML = '<i class="fa-solid fa-circle-xmark"></i>';
    modalContent.appendChild(span);
    //Verifico que este vacio el carrito de pedidos entonces imprimo un mensaje
    if (!pedidos.length) {
      const mensaje = document.createElement("div");
      mensaje.textContent = "No tiene productos en el carrito";
      mensaje.classList.add("carrito__vacio");
      modalContent.appendChild(mensaje);
      return modalContent;
    }
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
                <a class="btns-editar" href="ver-producto?id=${id}"><i class="fa-solid fa-user-pen"></i></a>
                <a class="btns-eliminar" data-id="${id}" data-talla="${talla}"><i class="fa-solid fa-circle-xmark"></i></a>
                </div>
               `;
      modalContent.append(div);
    });



    return modalContent;
  }

  function limpiarCarrito() {
    const modalContent = document.querySelector(".modal-content");
    if (modalContent) {
      while (modalContent.firstChild) {
        modalContent.removeChild(modalContent.firstChild);
      }
    }
  }

  function eliminarProducto(e) {
    let pedidos = JSON.parse(getCookie("pedidos")) || [];
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

    //Genero otra vez el contenido del modal ya que el modal ya existe
    generarCarrito();

  }

  function generarBtnPago(){
    let pedidos = JSON.parse(getCookie("pedidos")) || [];

    if(pedidos.length){
      const modalContent = document.querySelector(".modal-content");
      const btnPago=document.createElement("a")
      btnPago.classList.add("btn-pago")
      btnPago.textContent="Comprar"
      btnPago.href="/pagar"
      modalContent.appendChild(btnPago)
    }

  }
});
