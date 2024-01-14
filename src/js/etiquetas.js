(function() {

    const tagsInput = document.querySelector('#etiquetas_input')

    if(tagsInput) {

        const tagsDiv = document.querySelector('#etiquetas');
        const tagsInputHidden = document.querySelector('[name="etiquetas"]');

        let etiquetas = [];

        // Recuperar del input oculto
        if(tagsInputHidden.value !== '') {
            etiquetas = tagsInputHidden.value.split(',');
            mostrarTags();
        }
 
        // Escuchar los cambios en el input
        tagsInput.addEventListener('keypress', guardarTag)

        function guardarTag(e) {
            if(e.keyCode === 44) {
                if(e.target.value.trim() === '' || e.target.value < 1) { 
                    return
                }
                e.preventDefault();
                etiquetas = [...etiquetas, e.target.value.trim()];
                tagsInput.value = '';
                mostrarTags();
            }
        }

        function mostrarTags() {
            tagsDiv.textContent = '';
            etiquetas.forEach(tag => {
                const etiqueta = document.createElement('LI');
                etiqueta.classList.add('formulario__tag')
                etiqueta.textContent = tag;
                etiqueta.ondblclick = eliminarTag
                tagsDiv.appendChild(etiqueta)
            })
            actualizarInputHidden();
        }   

        function eliminarTag(e) {
            e.target.remove()
            etiquetas = etiquetas.filter(tag => tag !== e.target.textContent)
            actualizarInputHidden();
        }

        function actualizarInputHidden() {
           tagsInputHidden.value = etiquetas.toString();
        }
    }

})();