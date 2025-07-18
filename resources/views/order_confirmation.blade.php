@extends('layouts.app')

@section('title', 'Pedido Confirmado')

@section('content')
<div class="container my-5 text-center">
    <div class="card shadow-lg p-5">
        <i class="fas fa-check-circle text-success mb-4" style="font-size: 5rem;"></i>
        <h2 class="mb-3">¡Tu pedido ha sido confirmado!</h2>
        <p class="lead mb-4">Gracias por tu compra. Recibirás un correo de confirmación pronto con los detalles de tu pedido.</p>
        <a href="{{ route('welcome') }}" class="btn btn-primary btn-lg rounded-pill">Volver al inicio</a>
    </div>
</div>
@endsection
