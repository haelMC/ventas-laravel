@extends('layouts.app')

@section('content')
<div class="container bg-white p-4 shadow mt-4 rounded-3">
    <div class="row">
        <div class="col-md-6">
            <img src="{{ asset('images/logo-hydra.jpg') }}" alt="Logo" style="height: 80px">
        </div>
        <div class="col-md-6 text-end">
            <h5 class="fw-bold mb-0">R.U.C. 20100100100</h5>
            <h5 class="text-uppercase">Boleta de Venta Electrónica</h5>
            <h5 class="text-primary">N° B002 - {{ str_pad($venta->id, 8, '0', STR_PAD_LEFT) }}</h5>
        </div>
    </div>

    <hr class="my-2">

    <div class="row mb-3">
        <div class="col-md-6">
            <p><strong>Cliente:</strong> {{ $venta->user->name }}</p>
            <p><strong>Dirección:</strong> - </p>
            <p><strong>DNI:</strong> 71262017</p>
        </div>
        <div class="col-md-6 text-end">
            <p><strong>Fecha Emisión:</strong> {{ $venta->created_at->format('d/m/Y') }}</p>
            <p><strong>Cond. de Pago:</strong> Contado</p>
        </div>
    </div>

    <table class="table table-bordered text-center align-middle">
        <thead class="table-light">
            <tr>
                <th>Cant.</th>
                <th>U.M</th>
                <th>Descripción</th>
                <th>Precio Unit. (S/)</th>
                <th>Importe (S/)</th>
            </tr>
        </thead>
        <tbody>
            @php
                $total = 0;
                $op_gravada = 0;
                $igv = 0.18;
            @endphp
            @foreach($venta->detalles as $item)
                @php
                    $subtotal = $item->precio_unitario * $item->cantidad;
                    $op_gravada += $subtotal / (1 + $igv);
                    $total += $subtotal;
                @endphp
                <tr>
                    <td>{{ $item->cantidad }}</td>
                    <td>UNIDAD</td>
                    <td>{{ strtoupper($item->producto->nombre) }}</td>
                    <td>{{ number_format($item->precio_unitario, 2) }}</td>
                    <td>{{ number_format($subtotal, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="row justify-content-end">
        <div class="col-md-6">
            <table class="table table-borderless">
                <tr>
                    <th class="text-end">Op. Gravada (S/):</th>
                    <td class="text-end">{{ number_format($op_gravada, 2) }}</td>
                </tr>
                <tr>
                    <th class="text-end">IGV (18%) (S/):</th>
                    <td class="text-end">{{ number_format($total - $op_gravada, 2) }}</td>
                </tr>
                <tr>
                    <th class="text-end fw-bold">Importe Total (S/):</th>
                    <td class="text-end fw-bold">{{ number_format($total, 2) }}</td>
                </tr>
            </table>
        </div>
    </div>

    <div class="mt-3">
        <p><strong>Son:</strong> <td class="text-end fw-bold">{{ number_format($total, 2) }}</td> CON 00/100 SOLES</p>
    </div>

    <div class="mt-4 text-end">
        <a href="{{ route('ventas.mis') }}" class="btn btn-outline-secondary">⬅️ Volver a Mis Compras</a>
    </div>

    <footer class="mt-4 text-center text-muted small">
        Representación impresa de BOLETA DE VENTA ELECTRÓNICA. Autorizado por SUNAT.<br>
        www.mifact.net
    </footer>
</div>
@endsection
