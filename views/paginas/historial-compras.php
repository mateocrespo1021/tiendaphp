<div class="historias contenedor">
    <h1>
        <?php echo $titulo; ?>
    </h1>
    <?php if (!empty($compras)) { ?>
        <?php foreach ($compras as $compra) {
            ; ?>
            <div class="historia">
                <div class="historia__header">
                    <p>
                        Pedido :
                        <?php echo $compra->id_transaccion; ?>
                    </p>
                    <p>
                        Fecha :
                        <?php echo $compra->fecha; ?>
                    </p>
                </div>
                <?php foreach ($compra->detalles_compra as $detalle) {
                    ; ?>
                    <div class="historia__detalle">
                        <p>
                            Producto :
                            <?php echo $detalle->nombre; ?>
                        </p>
                        <p>
                            Precio :
                            <?php echo $detalle->precio; ?>
                        </p>
                        <p>
                            Cantidad :
                            <?php echo $detalle->cantidad; ?>
                        </p>
                        <p>
                            Talla :
                            <?php echo $detalle->talla; ?>
                        </p>
                    </div>
                <?php }
                ; ?>
                <p class="historia__total">
                    Total : $
                    <?php echo $compra->total; ?>
                </p>
            </div>

        <?php }
        ; ?>
    <?php } else {?>
          <h2>No tiene ninguna compra realizada</h2>
        <?php } ;?>

</div>