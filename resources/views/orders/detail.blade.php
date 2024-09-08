@extends('adminlte::page')

@section('content')

<!-- admin.order-details.blade.php -->

    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Detalles del Pedido #{{ $order->id }}</h5>
            </div>
            <div class="card-body">
                <p class="card-text">Fecha del Pedido: {{ $order->created_at->format('d M Y, h:i A') }}</p>
                <p class="card-text">Total del Pedido: ${{ number_format($order->total, 2) }}</p>
                <p class="card-text">Usuario: {{$user->name}} </p>
                <p class="card-text">Correo: {{$user->email}} </p>
                <p class="card-text">Direccion: {{$address->department}}, {{$address->city}}, {{$address->neighborhood}}, {{$address->street_type}}  {{$address->street}}, {{$address->number}} </</p>
                <p class="card-text">Estado: {{$order->status}}</p>

                <h6 class="mt-4">Productos</h6>
                <ul class="list-group">
                    @foreach ($orderdetail as $item)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                {{ $item->product->name }}
                                <span class="badge bg-secondary rounded-pill">{{ $item->quantity }}</span>
                            </div>
                            <span class="badge bg-primary rounded-pill">${{ number_format($item->price * $item->quantity, 2) }}</span>
                        </li>
                    @endforeach
                </ul>

                <div class="mt-4">
                    <h6 class="card-subtitle mb-2 text-muted">Total: ${{ number_format($order->total, 2) }}</h6>
                </div>
            </div>
        </div>
    </div>



@endsection