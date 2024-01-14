<h2 class="dashboard__heading">
    <?php echo $titulo; ?>
</h2>

<div class="dashboard__contenedor">

    <?php if (!empty($ventas)) { ?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">Transacción</th>
                    <th scope="col" class="table__th">Fecha</th>
                    <th scope="col" class="table__th">Estado</th>
                    <th scope="col" class="table__th">Email</th>
                    <th scope="col" class="table__th">Total</th>
                    <th scope="col" class="table__th"></th>
                </tr>
            </thead>
            <tbody class="table__tbody">
                <?php foreach ($ventas as $venta) { ?>
                    <tr class="table__tr">
                        <td class="table__td">
                            <?php echo $venta->id_transaccion; ?>
                        </td>
                        <td class="table__td">
                            <?php echo $venta->fecha; ?>
                        </td>
                        <td class="table__td">
                            <?php echo $venta->status; ?>
                        </td>
                        <td class="table__td">
                        <?php echo $venta->email; ?>
                        </td>
                        <td class="table__td">
                        <?php echo $venta->total; ?>
                        </td>
                        <td class="table__td--acciones">      
                        <a class="table__accion table__accion--editar"
                                href="/admin/detalle-venta?id=<?php echo $venta->id; ?>">
                                <i class="fa-solid fa-user-pen"></i>
                                Ver Detalles
                            </a>
                        </td>
                    </tr>
                    <?php
                } ?>
            </tbody>
        </table>
        <?php
    } else { ?>
        <p class="text-center">No Hay Ventas Aún</p>
        <?php
    } ?>

</div>

<?php
echo $paginacion;
?>