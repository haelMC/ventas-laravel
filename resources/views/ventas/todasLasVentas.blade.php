@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h3 class="mb-4 fw-bold">📋 Boletas de todos los usuarios</h3>

    @forelse($ventas as $venta)
        <div class="card mb-3 shadow-sm rounded-4 border-0">
            <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                <div>
                    Venta #{{ $venta->id }} – {{ $venta->user->name }}
                    <span class="ms-3">🕒 {{ $venta->created_at->format('d/m/Y H:i') }}</span>
                </div>
                <a href="{{ route('boleta.ver', $venta->id) }}" class="btn btn-sm btn-light">Ver boleta</a>
            </div>
            <div class="card-body">
                <ul class="list-group">
                    @foreach($venta->detalles as $detalle)
                        <li class="list-group-item d-flex justify-content-between">
                            {{ $detalle->producto->nombre }} × {{ $detalle->cantidad }}
                            <span>S/. {{ number_format($detalle->precio_unitario * $detalle->cantidad, 2) }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    @empty
        <div class="alert alert-info">No hay ventas registradas aún.</div>
    @endforelse
</div>
@endsection
