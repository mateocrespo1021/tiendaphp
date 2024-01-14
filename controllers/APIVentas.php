<?php

namespace Controllers;

use DateTime;
use Model\Compra;

class APIVentas
{

    public static function index()
    {
        $ventas = Compra::all();
        foreach ($ventas as $venta) {
            // Convertir la cadena de fecha a objeto DateTime
            $fecha_objeto = new DateTime($venta->fecha);
            // Obtener el nombre del mes como cadena
            $nombre_mes = $fecha_objeto->format('F');
            $venta->mes = $nombre_mes;
        }
        echo json_encode($ventas);
    }

}