<x-app-layout>

    <div class="container mx-auto mt-10 max-w-2xl pb-20">
        <div class="bg-white p-8 rounded-lg shadow-xl">
            <div class="text-center mb-8">
                <h1 class="text-3xl font-semibold text-gray-800">Detalles del Pedido</h1>
                <p class="text-gray-600">Aquí encontrarás información detallada sobre tu pedido.</p>
            </div>

            <div class="my-4">
                <p class="text-gray-600 mb-2">Número de Pedido: <span class="font-semibold">#{{ $order->id }}</span></p>
                <p class="text-gray-600 mb-2">Fecha del Pedido: {{ $order->created_at->format('d M Y, h:i A') }}</p>
                <p class="text-gray-600 mb-2">Total del Pedido: ${{ number_format($order->total, 2) }}</p>
            </div>

            <div class="mt-4">
                <h2 class="text-xl font-semibold mb-2">Productos</h2>
                <ul>
                    @foreach ($orderdetail as $item)
                        <li class="flex justify-between items-center border-b border-gray-300 py-2">
                            <div>
                                <p class="text-gray-800">{{ $item->product->name }}</p>
                                <img class="hover:grow hover:shadow-lg object-cover object-center rounded-md" style="max-height: 50px;" src="{{ asset('images_products/' . $item->product->image) }}" alt="{{ $item->product->name }}">
                                <p class="text-gray-600">Cantidad: {{ $item->quantity }}</p>
                            </div>
                            <p class="text-gray-800">${{ number_format($item->price * $item->quantity, 2) }}</p>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="flex justify-end mt-4">
                <span class="text-gray-800 font-semibold">Total: ${{ number_format($order->total, 2) }}</span>
            </div>
        </div>
    </div>
    <br><br>

</x-app-layout>
