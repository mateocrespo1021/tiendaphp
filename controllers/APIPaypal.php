<?php

namespace Controllers;

use Classes\Email;
use Classes\PDFInvoice;
use Model\Compra;
use Model\DetalleCompra;
use Model\Invoice;
use Model\Talla;

class APIPaypal
{

    public static function guardarCompra()
    {
        try {
            if ($_SERVER["REQUEST_METHOD"] === "POST") {

                // Obtiene los datos del cuerpo de la solicitud
                $datos_json = file_get_contents('php://input');

                // Decodifica el JSON a un array de PHP
                $datos = json_decode($datos_json, true);



                // Verifica si los datos están presentes y son un arreglo
                if ($datos && is_array($datos)) {
                    // Accede a los datos según las claves
                   

                    $argsCompra = array(
                        'id_transaccion' => $datos['detalles']['id'],
                        'total' => $datos['detalles']['purchase_units'][0]['amount']['value'],
                        'status' => $datos['detalles']['status'],
                        'fecha' => date('Y-m-d H:i:s', strtotime($datos['detalles']['update_time'])),
                        'email' => $datos['detalles']['payer']['email_address'],
                        'id_cliente' => $datos['detalles']['payer']['payer_id']
                    );

                    $compra = new Compra($argsCompra);

                    // Iniciar la sesión
                    session_start();

                    if (isset($_SESSION['id'])) {
                        Compra::agregarColumna('id_usuario');
                        $compra->id_usuario = $_SESSION['id'];
                    }

                    $resultado = $compra->guardar();

                    //Guardo el invoice

                    $argsInvoice = array(
                        'nombres' => $datos['invoice']['nombre'],
                        'apellidos' => $datos['invoice']['apellido'],
                        'telefono' => $datos['invoice']['telefono'],
                        'email' => $datos['invoice']['email'],
                        'pais' => $datos['invoice']['pais'],
                        'departamento' => $datos['invoice']['departamento'],
                        'provincia' => $datos['invoice']['provincia'],
                        'codigo_postal' => $datos['invoice']['codigo_postal'],
                        'id_compra' => $resultado['id']
                    );

                    $invoice = new Invoice($argsInvoice);

                    $resultadoInvoice = $invoice->guardar();


                    //Guardo todos los detalles de compra

                    foreach ($datos['pedidos'] as $pedido) {

                        $argsDetalleCompra = array(
                            'id_compra' => $resultado['id'],
                            'id_producto' => $pedido['id'],
                            'nombre' => $pedido['nombre'],
                            'precio' => $pedido['precio'],
                            'cantidad' => $pedido['cantidad'],
                            'talla' => $pedido['talla'],
                        );

                        $detalle_compra = new DetalleCompra($argsDetalleCompra);

                        $detalle_compra->guardar();

                        //Actualizar stock
                        $tallas = Talla::whereArray(['producto_id' => $pedido['id'], 'nombre' => $pedido['talla']]);
                        $talla = array_shift($tallas);
                        $talla->stock = $talla->stock - $pedido['cantidad'];
                        $talla->guardar();
                    }


                    //Generar invoice y enviarlo

                    $invoice->id = $resultadoInvoice["id"];

                    $pdfInvoice = new PDFInvoice();


                    $generoFactura = $pdfInvoice->generarInvoice($invoice, $datos['pedidos']);



                    $mail = new Email($invoice->email, $invoice->nombres);


                    $mail->enviarInvoice($generoFactura);



                    echo json_encode(["mensaje" => "Compra realizada con exito"]);
                }

                echo json_encode([]);
            }
        } catch (\Exception $e) {
            // Manejar la excepción aquí (puedes registrarla, enviar correos electrónicos, etc.)
            error_log("Error al procesar la compra: " . $e->getMessage());
            // Puedes también lanzar nuevamente la excepción si quieres que se propague
            throw $e;
        }
    }



}