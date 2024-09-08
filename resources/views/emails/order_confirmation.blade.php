<!-- resources/views/emails/order_confirmation.blade.php -->

<div>
    <h1>¡Pedido Confirmado!</h1>
    <p>Gracias por tu compra.</p>

    <div>
        <h2>Detalles del Pedido</h2>
        <p>Número de Pedido: #{{ $order->id }}</p>
        <p>Fecha del Pedido: {{ $order->created_at->format('d M Y, h:i A') }}</p>
        <p>Total del Pedido: ${{ number_format($order->total, 2) }}</p>

        <h3>Productos</h3>
        <ul>
            @foreach ($order->orderItems as $item)
                <li>
                    <p>{{ $item->product->name }}</p>
                    <img  src="{{ asset('images_products/' . $item->product->image) }}" alt="{{ $item->product->name }}">
                    <p>Cantidad: {{ $item->quantity }}</p>
                    <p>Precio: ${{ number_format($item->price * $item->quantity, 2) }}</p>
                </li>
            @endforeach
        </ul>

        <p>Total: ${{ number_format($order->total, 2) }}</p>
    </div>
</div>



