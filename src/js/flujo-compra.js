(function (window, document) {
  document.addEventListener("DOMContentLoaded", () => {
    const btnInvoice = document.querySelector("#btn-invoice");
    const formulario = document.querySelector("#miForm");
    const btnAnterior = document.querySelector("#btn-anterior");
    let stepper1;
    iniciarSteeper();
    if (btnInvoice) {
      btnInvoice.addEventListener("click", (e) => {
        e.preventDefault();
        obtenerDatos();
      });

      btnAnterior.addEventListener("click",()=>{
        stepper1.previous()
      })
    }

    function obtenerDatos() {
      const formData = new FormData(formulario);
      let objInvoice = {};
      formData.forEach(function (value, key) {
        objInvoice[key] = value;
      });

      //Validar

      if (Object.values(objInvoice).includes("")) {
        alerta("Todos los campos son requeridos");
        return;
      }

      //Guardar la informacion en el localStorage para posterior al pagar con paypal , guardar en la base de datos

      localStorage.setItem('invoice',JSON.stringify(objInvoice))

      stepper1.next();
    }

    function alerta(mensaje) {
      if (document.querySelector('.alerta__error--mensaje')) {
        return
      }
      const divAlert = document.createElement("div");
      divAlert.textContent = mensaje;
      divAlert.classList.add("alerta__error","alerta__error--mensaje");
      formulario.before(divAlert);

      setTimeout(() => {
        divAlert.remove()
      }, 5000);
    }

    function iniciarSteeper() {
      stepper1 = new Stepper(document.querySelector("#stepper1"));
    }
  });
})(window, document);
