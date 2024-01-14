import Swal from 'sweetalert2'

(function (window, document) {
    document.addEventListener("DOMContentLoaded", () => {
        const btnProductos = document.querySelector("#btn-productos")
        const btnCategoria = document.querySelectorAll(".eliminar-categoria")

        if (btnCategoria) {
            btnCategoria.forEach((btn)=>{
                btn.addEventListener("click", mostrarAlerta)
            })
           
        }

        function mostrarAlerta(e) {
            e.preventDefault()
            Swal.fire({
                title: 'Estas seguro de esto?',
                text: "Si eliminas esta categoria , todos los productos relacionados se eliminaran!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si , eliminalo!'
            }).then(async (result) => {
                if (result.isConfirmed) {
                    // Objeto de formdata
                    const id = document.querySelector("#id-categoria").value
                    const datos = new FormData();
                    datos.append('id', id)
                    const url = '/admin/categorias/eliminar'
                    const respuesta = await fetch(url, {
                        method: 'POST',
                        body: datos
                    })
                    const resultado = await respuesta.json();
                    if (resultado) {
                        window.location.href = "/admin/categorias";
                    }

                }
            })
        }

        if (btnProductos) {
            btnProductos.addEventListener("click", async (e) => {
                e.preventDefault()
                const total = await consultarApi()
                if (total == 0) {
                    Swal.fire({
                        title: 'Error',
                        text: 'Debe agregar al menos una categoria',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    })
                    return
                }
                // Redirigir a una URL específica
                window.location.href = "/admin/productos/crear";

            })
        }

        async function consultarApi() {
            const url = "/api/categorias-total";

            const resultado = await fetch(url);
            const total = await resultado.json();
            return total
        }
    })
})(window, document);