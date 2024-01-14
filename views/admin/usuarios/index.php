<h2 class="dashboard__heading">
    <?php echo $titulo; ?>
</h2>

<!-- <div class="dashboard__contenedor-boton">
    <a  class="dashboard__boton" href="/admin/usuarios/correo">
        <i class="fa-solid fa-circle-plus"></i>
        Enviar Correo a sus Usuarios
    </a>
</div> -->

<div class="dashboard__contenedor">

    <?php if (!empty($usuarios)) { ?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">Nombre</th>
                    <th scope="col" class="table__th">Apellido</th>
                    <th scope="col" class="table__th">Email</th>
                    <th scope="col" class="table__th">Estado</th>
                    <th scope="col" class="table__th"></th>
                </tr>
            </thead>
            <tbody class="table__tbody">
                <?php foreach ($usuarios as $usuario) { ?>
                    <tr class="table__tr">
                        <td class="table__td">
                            <?php echo $usuario->nombre; ?>
                        </td>
                        <td class="table__td">
                            <?php echo $usuario->apellido; ?>
                        </td>
                        <td class="table__td">
                            <?php echo $usuario->email; ?>
                        </td>
                        <td class="table__td">
                            <?php echo ($usuario->estado) ? 'Activado' : 'Desactivado'; ?>
                        </td>
                        <td class="table__td--acciones">      
                            <?php if ($usuario->estado) {
                                ; ?>
                                <form action="/admin/usuarios/desactivar" method="post" class="table__formulario">
                                    <input type="hidden" name="id" value="<?php echo $usuario->id; ?>">
                                    <button class="table__accion table__accion--eliminar" type="submit">
                                        <i class="fa-solid fa-circle-xmark"></i>
                                        Desactivar Cuenta
                                    </button>
                                </form>
                            <?php } else {
                                ; ?>
                                <form action="/admin/usuarios/activar" method="post" class="table__formulario">
                                    <input type="hidden" name="id" value="<?php echo $usuario->id; ?>">
                                    <button class="table__accion table__accion--editar" type="submit">
                                    <i class="fa-solid fa-check"></i>
                                        Activar Cuenta
                                    </button>
                                </form>
                            <?php }
                            ; ?>
                        </td>
                    </tr>
                    <?php
                } ?>
            </tbody>
        </table>
        <?php
    } else { ?>
        <p class="text-center">No Hay Usuarios Aún</p>
        <?php
    } ?>

</div>

<?php
echo $paginacion;
?>