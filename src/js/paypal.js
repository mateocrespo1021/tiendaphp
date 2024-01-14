const { calcularTotal } = require("./funciones.js");
import { getCookie } from "./funciones.js";

function initPayPalButton() {
  const total = calcularTotal();

  if (!document.querySelector("#paypal-button-container")) {
    return;
  }

  paypal
    .Buttons({
      style: {
        shape: "rect",
        color: "blue",
        layout: "vertical",
        label: "pay",
      },

      createOrder: function (data, actions) {
        return actions.order.create({
          purchase_units: [
            {
              description: "1",
              amount: { currency_code: "USD", value: total },
            },
          ],
        });
      },

      onApprove: async function (data, actions) {
        return actions.order.capture().then(function (detalles) {
          // Full available details
          console.log(
            "Capture result",
            detalles,
            JSON.stringify(detalles, null, 2)
          );

          let pedidos = JSON.parse(getCookie("pedidos")) || [];
          let invoice = JSON.parse(localStorage.getItem("invoice")) || [];

          try {
            const url = "/api/guardar-compra";

            fetch(url, {
              method: "post",
              headers: {
                "Content-Type": "application/json",
              },
              body: JSON.stringify({
                detalles: detalles,
                pedidos: pedidos,
                invoice: invoice,
              }),


            })
            ;
          } catch (error) {
            throw error
          }
        });
      },

      onError: function (err) {
        console.log(err);
      },
    })
    .render("#paypal-button-container");
}

initPayPalButton();
