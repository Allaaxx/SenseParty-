<div class="total-section">
    <table class="total-table">
        <thead class="total-table-head">
            <tr class="table-total-row">
                <th>Total</th>
                <th>Preço</th>
            </tr>
        </thead>
        <tbody>
            @if ($cartItems->isEmpty())
                <tr class="total-data">
                    <td colspan="2">Seu carrinho está vazio!</td>
                </tr>
            @else
                <tr class="total-data">
                    <td><strong>Subtotal: </strong></td>
                    <td>R$ {{ number_format($subtotal, 2, ',', '.') }}</td>
                </tr>
                <tr class="total-data">
                    <td><strong>Frete: </strong></td>
                    <td>R$ {{ number_format($shippingCost, 2, ',', '.') }}</td>
                </tr>
                <tr class="total-data">
                    <td><strong>Total: </strong></td>
                    <td>R$ {{ number_format($subtotal + $shippingCost, 2, ',', '.') }}</td>
                </tr>
                <tr class="total-data">
                    <td colspan="2">
                        <div class="d-flex justify-content-center">
                            <form method="GET" action="{{ route('checkout') }}" style="background-color: black;">
                                @csrf <!-- Adiciona o token CSRF -->
                                <!-- Outros campos do formulário aqui -->
                                <button type="submit" >Finalizar Compra</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endif
        </tbody>
    </table>
</div>
