<form action="/create-payment" method="POST">
    @csrf
    <input type="text" name="amount" placeholder="Valor do Pagamento" required>
    <input type="text" name="order_id" placeholder="ID do Pedido" required>
    <button type="submit">Pagar</button>
</form>