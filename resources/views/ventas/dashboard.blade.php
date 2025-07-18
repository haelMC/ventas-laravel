@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="mb-4 fw-bold text-center">📊 Dashboard de Ventas</h2>

    <div class="row text-center mb-4">
        <div class="col-md-6">
            <div class="card shadow-sm p-4">
                <h4 class="text-muted">Total de Ventas</h4>
                <h2 class="fw-bold">{{ $totalVentas }}</h2>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow-sm p-4">
                <h4 class="text-muted">Ingresos Totales</h4>
                <h2 class="fw-bold">S/ {{ number_format($ingresosTotales, 2) }}</h2>
            </div>
        </div>
    </div>

    <div class="row mb-5">
        <div class="col-md-12">
            <div class="card p-4">
                <h5 class="fw-bold mb-3">🥇 Productos más vendidos</h5>
                <table class="table table-striped table-hover text-center">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Cantidad Vendida</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($productosVendidos as $producto)
                            <tr>
                                <td>{{ $producto['nombre'] }}</td>
                                <td>{{ $producto['cantidad'] }}</td>
                            </tr>
                        @endforeach
                        @if (count($productosVendidos) === 0)
                            <tr><td colspan="2" class="text-muted">No hay ventas aún.</td></tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="card p-4">
        <h5 class="fw-bold mb-3">🧾 Últimas Ventas</h5>
        <table class="table table-sm table-bordered text-center">
            <thead>
                <tr>
                    <th># Venta</th>
                    <th>Cliente</th>
                    <th>Fecha</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($ventas->sortByDesc('created_at')->take(5) as $venta)
                    <tr>
                        <td>{{ $venta->id }}</td>
                        <td>{{ $venta->user->name }}</td>
                        <td>{{ $venta->created_at->format('d/m/Y H:i') }}</td>
                        <td>S/ {{ number_format($venta->total, 2) }}</td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="text-muted">No hay ventas aún.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
