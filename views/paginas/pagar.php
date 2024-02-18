<div id="div-vacio" class="mensaje-vacio">
    <p>No tiene productos agregados</p>
    <a class="mensaje-boton" href="/productos">Ir a ver Porductos</a>
</div>

<div id="contenedor-pagar" class="pagar contenedor ocultar">
    <div class="mb-5 p-4 bg-white shadow-sm">
        <div id="stepper1" class="bs-stepper">
            <div class="bs-stepper-header" role="tablist">
                <div class="step" data-target="#test-l-1">
                    <button type="button" class="step-trigger" role="tab" id="stepper1trigger1"
                        aria-controls="test-l-1">
                        <span class="bs-stepper-circle">1</span>
                        <span class="bs-stepper-label">Detalle Invoice</span>
                    </button>
                </div>
                <div class="bs-stepper-line"></div>
                <div class="step" data-target="#test-l-2">
                    <button type="button" class="step-trigger" role="tab" id="stepper1trigger2"
                        aria-controls="test-l-2">
                        <span class="bs-stepper-circle">2</span>
                        <span class="bs-stepper-label">Pago</span>
                    </button>
                </div>

            </div>
            <div class="bs-stepper-content">

                <div id="test-l-1" role="tabpanel" class="bs-stepper-pane" aria-labelledby="stepper1trigger1">
                    <div class="form-group">
                        <form id="miForm" method="POST" action="/registro" class="formulario">
                            <h3>Detalle de Invoice</h3>
                            <div class="formulario__campos">
                                <div class="formulario__campo">
                                    <label for="nombre" class="formulario__label">Nombres</label>
                                    <input type="text" class="formulario__input" placeholder="Tu Nombre" id="nombre"
                                        name="nombre" required>
                                </div>

                                <div class="formulario__campo">
                                    <label for="apellido" class="formulario__label">Apellido</label>
                                    <input type="text" class="formulario__input" placeholder="Tu Apellido" id="apellido"
                                        name="apellido" required>
                                </div>
                            </div>
                            <div class="formulario__campos">
                                <div class="formulario__campo">
                                    <label for="telefono" class="formulario__label">Telefono</label>
                                    <input type="tel" class="formulario__input" placeholder="Tu Telefono" id="telefono"
                                        name="telefono" required>
                                </div>
                                <div class="formulario__campo">
                                    <label for="email" class="formulario__label">Email</label>
                                    <input type="email" class="formulario__input" placeholder="Tu Email" id="email"
                                        name="email" required>
                                </div>
                            </div>

                            <div class="formulario__campo">
                                <label for="pais" class="formulario__label">Pais</label>
                                <select class="formulario__input" name="pais" id="pais" required>
                                    <option value="" selected>Seleccionar</option>
                                    <option value="Ecuador">Ecuador</option>
                                    <option value="Mexico">Mexico</option>
                                    <option value="Peru">Peru</option>
                                    <option value="Colombia">Colombia</option>
                                    <option value="Argentina">Argentina</option>
                                </select>
                            </div>

                            <div class="formulario__campo">
                                <label for="departamento" class="formulario__label">Departamento</label>
                                <input type="text" class="formulario__input" placeholder="Tu Departamento"
                                    id="departamento" name="departamento" required>
                            </div>


                            <div class="formulario__campo">
                                <label for="provincia" class="formulario__label">Provincia</label>
                                <input type="text" class="formulario__input" placeholder="Tu Provincia" id="provincia"
                                    name="provincia" required>
                            </div>

                            <div class="formulario__campo">
                                <label for="codigo_postal" class="formulario__label">Codigo Postal</label>
                                <input type="number" class="formulario__input" placeholder="Tu Codigo Postal"
                                    id="codigo_postal" name="codigo_postal" required>
                            </div>
                            <input id="btn-invoice" type="submit" class="formulario__submit" value="Siguiente">
                        </form>
                    </div>
                </div>
                <div id="test-l-2" role="tabpanel" class="bs-stepper-pane" aria-labelledby="stepper1trigger2">
                    <div class="form-group">
                        <h3>Pasarelas de Pago</h3>
                        <div class="pagos">
                            <div class="pagos__paypal" id="paypal-button-container"></div>
                        </div>
                        <script
                            src="https://www.paypal.com/sdk/js?client-id=<?php echo $_ENV['CLIENT_ID'] ?? ''; ?>&enable-funding=venmo&currency=USD"> // Replace YOUR_CLIENT_ID with your sandbox client ID
                            </script>
                    </div>
                    <button id="btn-anterior" class="formulario__submit">Anterior</button>
                </div>

            </div>
        </div>
    </div>

    <div class="resumen-pago">
        <h4 class="resumen__titulo">Productos Agregados</h4>
        <div class="carrito" id="productos-carrito">
            <h2 class="carrito__titulo">Agregados</h2>
        </div>
        <ul class="resumen__totales">
            <li>Subtotal <span class="count" id="det_subtotal_checkout"></span>$</li>
            <li>Total <span class="count" id="det_total_checkout"></span>$</li>
        </ul>
    </div>
</div>