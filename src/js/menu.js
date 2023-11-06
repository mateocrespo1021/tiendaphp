(function(window, document) {
    const menu=document.querySelector("#menu")
    const nav=document.querySelector("#nav")
    if (menu) {
        menu.addEventListener("click",mostrarMenu)
        function mostrarMenu(){
            console.log("click");
            nav.classList.toggle("activar")
        }
    }
})(window, document);