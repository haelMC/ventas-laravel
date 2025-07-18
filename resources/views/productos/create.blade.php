@extends('layouts.app')

@section('title', 'Crear producto')

@section('content')
<div class="container py-5">
    <h2 class="mb-4 text-center fw-bold">Registrar nuevo producto</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Ups!</strong> Revisa los campos:<br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>• {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('productos.store') }}" method="POST" enctype="multipart/form-data" class="card p-4 shadow-lg rounded-4">
        @csrf

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre del producto</label>
            <input type="text" name="nombre" id="nombre" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea name="descripcion" id="descripcion" class="form-control" rows="3" required></textarea>
        </div>

        <div class="mb-3">
            <label for="precio" class="form-label">Precio (S/.)</label>
            <input type="number" step="0.01" name="precio" id="precio" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="stock" class="form-label">Stock disponible</label>
            <input type="number" name="stock" id="stock" class="form-control" required min="0">
        </div>

        <div class="mb-3">
            <label for="imagen" class="form-label">Imagen (opcional)</label>
            <input type="file" name="imagen" id="imagen" class="form-control">
        </div>

        <div class="text-end">
            <button type="submit" class="btn btn-success">Guardar producto</button>
            <a href="{{ route('productos.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>
@endsection
