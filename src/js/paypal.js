const { calcularTotal } = require("./funciones.js");

function initPayPalButton() {
  const total=calcularTotal()
  
   if (!document.querySelector("#paypal-button-container")) {
    return
   }
     
    paypal.Buttons({
      style: {
        shape: 'rect',
        color: 'blue',
        layout: 'vertical',
        label: 'pay',
      },

      createOrder: function(data, actions) {

        return actions.order.create({
          purchase_units: [{"description":"1","amount":{"currency_code":"USD","value":total}}]
        });
      },

      onApprove: function(data, actions) {
        return actions.order.capture().then(function(orderData) {

          // Full available details
          console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));

          // Show a success message within this page, e.g.
          const element = document.getElementById('paypal-button-container');
          element.innerHTML = '';
          element.innerHTML = '<h3>Thank you for your payment!</h3>';

          // Or go to another URL:  actions.redirect('thank_you.html');
          
        });
      },

      onError: function(err) {
        console.log(err);
      }
    }).render('#paypal-button-container');
  }

initPayPalButton();