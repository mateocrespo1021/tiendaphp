export function addCookie(name, value, days) {
    const date = new Date();
    date.setTime(date.getTime() + days * 24 * 60 * 60 * 1000);
    const expires = "expires=" + date.toUTCString();
    document.cookie = name + "=" + value + ";" + expires + ";path=/";
  }

export function getCookie(name) {
    const cookieName = name + "=";
    const decodedCookie = decodeURIComponent(document.cookie);
    const cookieArray = decodedCookie.split(";");

    for (let i = 0; i < cookieArray.length; i++) {
      let cookie = cookieArray[i];
      while (cookie.charAt(0) === " ") {
        cookie = cookie.substring(1);
      }

      if (cookie.indexOf(cookieName) === 0) {
        return cookie.substring(cookieName.length, cookie.length);
      }
    }

    return null; // Si la cookie no se encuentra
  }

export function calcularTotal(){
  let pedidos = JSON.parse(getCookie("pedidos")) || [];
  let total=0;
  if (pedidos) {
    pedidos.forEach(pedido => {
        //Obtenemos el total del precio por la cantidad
        const {precio,cantidad}=pedido
        let pre=precio
        pre*=cantidad
        //Sumamos al total
        total+=pre
    });
    
  }

  return total
  
}

export function mostrarTotal(){
  const p=document.querySelector("#total")
  if (p) {
    const total=calcularTotal()
    if (total>0) {
      p.textContent="El total a pagar es de :" + total
      return
    }
    p.textContent="No tiene productos agregados"
  }
}