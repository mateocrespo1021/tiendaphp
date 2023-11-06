<div class="carrito" id="productos-carrito">
  <h2 class="carrito__titulo">Agregados</h2>

</div>
<div class="pagos">
  <div class="pagos__total">
    <p id="total"></p>
  </div>
  <div id="paypal-button-container"></div>
  <script
    src="https://www.paypal.com/sdk/js?client-id=<?php echo $_ENV['CLIENT_ID'] ?? ''; ?>&enable-funding=venmo&currency=USD"> // Replace YOUR_CLIENT_ID with your sandbox client ID
    </script>
</div>