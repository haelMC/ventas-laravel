@extends('layouts.app')

@section('title', 'Catálogo de productos')

@section('content')
<div class="container py-5">
    <h2 class="mb-4 text-center fw-bold">Nuestros productos</h2>

    {{-- SOLO ADMIN VE BOTÓN CREAR --}}
    @auth
        @if(auth()->user()->role === 'admin')
            <div class="mb-4 text-end">
                <a href="{{ route('productos.create') }}" class="btn btn-primary">+ Crear producto</a>
            </div>
        @endif
    @endauth

    @if($productos->isEmpty())
        <p class="text-center text-muted">No hay productos disponibles.</p>
    @else
        <div class="row row-cols-1 row-cols-md-3 g-4">
            @foreach ($productos as $producto)
                <div class="col">
                    <div class="card h-100 shadow-sm border-0 rounded-4">
                        @if($producto->imagen)
                            <img src="{{ asset('storage/' . $producto->imagen) }}" class="card-img-top rounded-top-4" alt="{{ $producto->nombre }}">
                        @else
                            <img src="https://via.placeholder.com/400x250?text=Sin+imagen" class="card-img-top rounded-top-4" alt="Sin imagen">
                        @endif

                        <div class="card-body text-center">
                            <h5 class="card-title fw-bold">{{ $producto->nombre }}</h5>
                            <p class="card-text" style="text-align: justify;">{{ $producto->descripcion }}</p>
                            <p class="text-primary fw-semibold">S/. {{ number_format($producto->precio, 2) }}</p>
                            <p class="card-text"><strong>Stock:</strong> {{ $producto->stock }}</p>

                            {{-- BOTONES SEGÚN ROL --}}
                            @auth
                                @if(auth()->user()->role === 'admin')
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('productos.edit', $producto->id) }}" class="btn btn-sm btn-warning">Editar</a>
                                        <form action="{{ route('productos.destroy', $producto->id) }}" method="POST" onsubmit="return confirm('¿Eliminar este producto?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger">Eliminar</button>
                                        </form>
                                    </div>
                                @elseif(auth()->user()->role === 'cliente')
                                    <form action="{{ route('carrito.agregar') }}" method="POST" class="mt-2">
                                        @csrf
                                        <input type="hidden" name="producto_id" value="{{ $producto->id }}">
                                        <input type="hidden" name="cantidad" value="1">
                                        <button class="btn btn-sm btn-dark rounded-pill px-3">Agregar al carrito 🛒</button>
                                    </form>
                                @endif
                            @endauth
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
