@extends('layouts.app')

@section('title', 'Historial de Compras') {{-- Añade un título específico para esta vista --}}

@section('content')
<div class="container mt-4 historial-container">
    <h3 class="mb-4 fw-bold">🧾 Historial de Compras</h3>

    @forelse($ventas as $index => $venta)
        <div class="card shadow-sm mb-4 border-0 rounded-4 historial-item" style="animation-delay: {{ $index * 0.1 }}s;">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <div>
                    <strong>Venta #{{ $venta->id }}</strong>
                    <span class="ms-3">🕒 {{ $venta->created_at->format('d/m/Y H:i') }}</span>
                </div>
                <a href="{{ route('boleta.ver', $venta->id) }}" class="btn btn-sm btn-light rounded-pill">
                    📄 Ver Boleta
                </a>
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    @php $total = 0; @endphp
                    @foreach($venta->detalles as $detalle)
                        @php
                            $subtotal = $detalle->precio_unitario * $detalle->cantidad;
                            $total += $subtotal;
                        @endphp
                        <li class="list-group-item d-flex justify-content-between">
                            <span>{{ $detalle->producto->nombre }} × {{ $detalle->cantidad }}</span>
                            <span>S/. {{ number_format($subtotal, 2) }}</span>
                        </li>
                    @endforeach
                    <li class="list-group-item d-flex justify-content-between fw-bold bg-light">
                        <span>Total</span>
                        <span>S/. {{ number_format($total, 2) }}</span>
                    </li>
                </ul>
            </div>
        </div>
    @empty
        <div class="alert alert-info text-center">No tienes compras registradas aún.</div>
    @endforelse
</div>
@endsection
