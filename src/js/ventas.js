(function () {
  const ctx = document.getElementById("ventas-grafica");

  if (ctx) {
    obtenerDatos();
    async function obtenerDatos() {
      const url = "/api/ventas";
      const respuesta = await fetch(url);
      const resultado = await respuesta.json();

      const mesesComprados = resultado.map((resul) => resul.mes);

      // Crear un objeto para almacenar la cantidad de compras por mes
      const conteoPorMes = {};

      // Recorrer el array original y contar las compras por mes
      mesesComprados.forEach((mes) => {
        if (conteoPorMes[mes]) {
          conteoPorMes[mes]++;
        } else {
          conteoPorMes[mes] = 1;
        }
      });

      // Obtener un array de meses sin repetidos
      const mesesSinRepetidos = Object.keys(conteoPorMes);

      // Obtener un array con la cantidad de compras por cada mes
      const cantidadPorMes = Object.values(conteoPorMes);


      new Chart(ctx, {
        type: "bar",
        data: {
          labels: mesesSinRepetidos,
          datasets: [
            {
              label: "",
              data: cantidadPorMes,
              borderWidth: 1,
              backgroundColor: [
                "#ea580c",
                "#84cc16",
                "#22d3ee",
                "#a855f7",
                "#ef4444",
                "#14b8a6",
                "#db2777",
                "#e11d48",
                "#7e22ce",
              ],
            },
          ],
        },
        options: {
          scales: {
            y: {
              beginAtZero: false,
            },
          },
        },
      });
    }
  }
})();
