@extends('layouts.app')

@section('title', 'Editar producto')

@section('content')
<div class="container py-5">
    <h2 class="mb-4 text-center fw-bold">Editar producto</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Errores encontrados:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>• {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('productos.update', $producto->id) }}" method="POST" enctype="multipart/form-data" class="card p-4 shadow-lg rounded-4">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" name="nombre" value="{{ old('nombre', $producto->nombre) }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea name="descripcion" class="form-control" rows="3" required>{{ old('descripcion', $producto->descripcion) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="precio" class="form-label">Precio</label>
            <input type="number" step="0.01" name="precio" value="{{ old('precio', $producto->precio) }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="stock" class="form-label">Stock</label>
            <input type="number" name="stock" value="{{ old('stock', $producto->stock) }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Imagen actual</label><br>
            @if($producto->imagen)
                <img src="{{ asset('storage/' . $producto->imagen) }}" alt="Imagen actual" width="150" class="mb-2 rounded-3">
            @else
                <p class="text-muted">No hay imagen</p>
            @endif
        </div>

        <div class="mb-3">
            <label for="imagen" class="form-label">Nueva imagen (opcional)</label>
            <input type="file" name="imagen" class="form-control">
        </div>

        <div class="text-end">
            <button type="submit" class="btn btn-success">Guardar cambios</button>
            <a href="{{ route('productos.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>
@endsection
