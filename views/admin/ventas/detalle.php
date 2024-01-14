<h2 class="dashboard__heading">
    <?php echo $titulo; ?>
</h2>

<div class="dashboard__contenedor">

    <?php if (!empty($detalles)) { ?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">Producto</th>
                    <th scope="col" class="table__th">Precio Unitario</th>
                    <th scope="col" class="table__th">Cantidad</th>
                    <th scope="col" class="table__th">Talla</th>
                    <th scope="col" class="table__th"></th>
                </tr>
            </thead>
            <tbody class="table__tbody">
                <?php foreach ($detalles as $detalle) { ?>
                    <tr class="table__tr">
                        <td class="table__td">
                            <?php echo $detalle->nombre; ?>
                        </td>
                        <td class="table__td">
                            <?php echo $detalle->precio; ?>
                        </td>
                        <td class="table__td">
                            <?php echo $detalle->cantidad; ?>
                        </td>
                        <td class="table__td">
                        <?php echo $detalle->talla; ?>
                        </td>
                    </tr>
                    <?php
                } ?>
            </tbody>
        </table>
        <?php
    } else { ?>
        <p class="text-center">No Hay Detalles</p>
        <?php
    } ?>

</div>