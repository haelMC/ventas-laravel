
@extends('layouts.app')

@section('title', 'Mi carrito')

@section('content')
<div class="container py-5">
    <h2 class="mb-4 text-center fw-bold">Mi carrito de compras</h2>

    @if(session('carrito') && count(session('carrito')) > 0)
        <div class="table-responsive">
            <table class="table table-bordered text-center align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Producto</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Subtotal</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    @php $total = 0; @endphp
                    @foreach(session('carrito') as $item)
                        @php
                            $subtotal = $item['precio'] * $item['cantidad'];
                            $total += $subtotal;
                        @endphp
                        <tr>
                            <td>{{ $item['nombre'] }}</td>
                            <td>S/. {{ number_format($item['precio'], 2) }}</td>
                            <td>{{ $item['cantidad'] }}</td>
                            <td>S/. {{ number_format($subtotal, 2) }}</td>
                            <td>
                                <form action="{{ route('carrito.eliminar', $item['id']) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">X</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    <tr class="table-light fw-bold">
                        <td colspan="3">TOTAL</td>
                        <td colspan="2">S/. {{ number_format($total, 2) }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="text-end mt-4">
            <form action="{{ route('checkout.form') }}" method="GET">
                <button class="btn btn-success btn-lg">Confirmar compra 🧾</button>
            </form>

        </div>
    @else
        <p class="text-center text-muted">Tu carrito está vacío 😢</p>
        <div class="text-center mt-4">
            <a href="{{ route('productos.index') }}" class="btn btn-primary">Ir a productos</a>
        </div>
    @endif
</div>
@endsection
