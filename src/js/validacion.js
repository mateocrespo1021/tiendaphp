import Swal from "sweetalert2";

(function (window, document) {
  let errores = [];
  const regex = /^([a-zA-Z0-9._%+-]+)@([a-zA-Z0-9.-]+\.[a-zA-Z]{2,})$/;
  const form = document.querySelector("#form-contacto");
  const inputNombre = document.querySelector("#from_name");
  const inputEmail = document.querySelector("#email_id");
  const inputWhatsapp = document.querySelector("#contact_number");
  const inputSelect = document.querySelector("#message");
  const divErrores = document.querySelector("#errores");
  const spinner = document.querySelector("#spinner");

  if (form) {
    form.addEventListener("submit", validarForm);
    function validarForm(e) {
      e.preventDefault();
      errores = [];
      //Validacion
      if (inputNombre.value == "") {
        errores = [...errores, "El nombre es obligatorio"];
      }

      if (!regex.test(inputEmail.value)) {
        errores = [...errores, "El email no es valido"];
      }

      if (inputWhatsapp.value == "") {
        errores = [...errores, "El WhatsApp es obligatorio"];
      }

      if (inputSelect.value == "") {
        errores = [...errores, "La Categoria es Obligatorio"];
      }

      //Mandar la info por FormDate

      if (!errores.length) {
        eliminarErrores();
        enviarInfo();
      }
      //Mostrar errores
      mostrarErrores();
    }

    function mostrarErrores() {
      eliminarErrores();
      errores.forEach((error) => {
        const pa = document.createElement("p");
        pa.classList.add("contacto__error");
        pa.textContent = error;
        divErrores.appendChild(pa);
      });
    }

    function eliminarErrores() {
      while (divErrores.firstChild) {
        divErrores.removeChild(divErrores.firstChild);
      }
    }

    async function enviarInfo() {
      agregarSpinner();
      //Pasa la validación
      //Objeto de formdata
      const serviceID = "default_service";
      const templateID = "template_chpydpg";

      emailjs.sendForm(serviceID, templateID, form).then(
        () => {
          Swal.fire({
            title: "Mensaje Enviado Exitosamente",
            text: "Te contactaremos lo más rapido posible",
            icon: "success",
            confirmButtonText: "OK",
          }).then(() => location.reload());
        },
        (err) => {
          Swal.fire({
            title: "Error",
            text: "Hubo un error , intenta otra vez",
            icon: "error",
            confirmButtonText: "OK",
          }).then(() => location.reload());
        }
      );


    function agregarSpinner() {
      spinner.classList.add("activo");
      form.classList.add("ocultar");
    }
    }}
})(window, document);
