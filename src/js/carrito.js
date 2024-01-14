import Swal from "sweetalert2";
import { addCookie, getCookie } from "./funciones.js";
(function (window, document) {
  document.addEventListener("DOMContentLoaded", () => {
    const btn = document.querySelector("#btn-carrito");
    const talla = document.querySelector("#talla");
    const cantidad = document.querySelector("#cantidad");
    //Interfaz objeto
    let repetido = false;
    let pedidos = JSON.parse(getCookie("pedidos")) || [];
    if (btn) {
      btn.addEventListener("click", agregarCarrito);
    }

    function agregarCarrito(e) {
      e.preventDefault();

      //Llenamos el pedido
      const parametros = new URLSearchParams(window.location.search);
      const pedido = {
        id: parametros.get("id"),
        talla: talla.value,
        cantidad: parseInt(cantidad.value),
      };
      if (
        Object.values(pedido).includes("") ||
        !Number.isInteger(pedido.cantidad)
      ) {
        Swal.fire({
          title: "Todos los campos deben ser llenados",
          text: "Debe seleccionar una talla y la cantidad debe ser minimo 1",
          icon: "error",
          confirmButtonText: "OK",
        });
        return;
      }

      //Pasamos a entero la cantidad

      //Validacion Correcta

      //Validar la cantidad
      const newPedidos = pedidos.map((element) => {
        if (element.id == pedido.id && element.talla == pedido.talla) {
          element.cantidad = pedido.cantidad;
          repetido = true;
          return element;
        }
        return element; // Si no es par, mantenemos el valor original
      });

      if (repetido) {
        pedidos = [...newPedidos];
        repetido = false;
        addCookie("pedidos", JSON.stringify(pedidos), 1);
      } else {
        pedido.nombre = e.target.closest('.producto__contenido').querySelector('.producto__nombre').textContent.trim();
        pedido.portada = e.target.closest('.producto__contenido').querySelector(".producto__imagen").src;
        pedido.precio = parseFloat(e.target.closest('.producto__contenido').querySelector(".producto__precio").textContent.trim().replace(/\$$/, '')) || 0;
        pedidos.push(pedido);
        console.log(pedidos);
        addCookie("pedidos", JSON.stringify(pedidos), 1);
        // (async () => {
        //   const info = await agregarInfo(pedido.id);
        //   pedido.nombre=info.nombre
        //   pedido.portada=info.portada
        //   pedido.precio=info.precio
        //   pedidos.push(pedido);
        //   addCookie("pedidos", JSON.stringify(pedidos), 1);
        // })();
      }

      Swal.fire("Agregado Correctamente!", "", "success");
      // Llama a la función para agregar una cookie
      // Agrega una cookie llamada "miCookie" que expirará en 7 días
    }

    async function agregarInfo(id) {
      const url = `/api/buscar-producto?id=${id}`;
      const respuesta = await fetch(url);
      const resultado = await respuesta.json();
      return resultado;
    }
  });
})(window, document);
