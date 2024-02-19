@extends('adminlte::page')

@section('content')

<div class="container mt-4">
    <h1 class="mb-4">Detalles del Mensaje</h1>
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Asunto: {{ $messagedetail->affair }}</h5>
        </div>
        <div class="card-body">
            <p class="card-text"><strong>Nombre:</strong> {{ $messagedetail->name }}</p>
            <p class="card-text"><strong>Correo:</strong> {{ $messagedetail->email }}</p>
            <p class="card-text"><strong>Teléfono:</strong> {{ $messagedetail->phone_number }}</p>
            <p class="card-text"><strong>Mensaje:</strong> {{ $messagedetail->message }}</p>

            <!-- Puedes agregar más detalles según sea necesario -->

            <a href="{{ route('contact.index') }}" class="btn btn-secondary mt-3">Volver a la Lista de Mensajes</a>
        </div>
    </div>
</div>

@endsection

