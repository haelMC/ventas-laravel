@extends('layouts.app')

@section('title', 'Pasarela de Pago')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow p-4">
                <h2 class="card-title text-center mb-4">Confirmar y Pagar</h2>
                <p class="text-center text-muted mb-4">Simulación de pasarela de pagos</p>

                @if(session('error'))
                    <div class="alert alert-danger text-center">{{ session('error') }}</div>
                @endif

                <form method="POST" action="{{ route('checkout.pagar') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="card_number" class="form-label">Número de Tarjeta</label>
                        <input type="text" name="card_number" class="form-control" required maxlength="19">
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="expiry_date" class="form-label">Fecha Expiración</label>
                            <input type="text" name="expiry_date" class="form-control" required maxlength="5">
                        </div>
                        <div class="col-md-6">
                            <label for="cvv" class="form-label">CVV</label>
                            <input type="text" name="cvv" class="form-control" required maxlength="4">
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="card_holder_name" class="form-label">Nombre del Titular</label>
                        <input type="text" name="card_holder_name" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Pagar Ahora</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
