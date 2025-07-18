@extends('layouts.app')

@section('title', 'Lista de Usuarios')

@section('content')
<div class="container py-5">
    <h2 class="mb-4 text-center fw-bold">Usuarios Registrados</h2>

    @if($usuarios->isEmpty())
        <p class="text-center text-muted">No hay usuarios registrados.</p>
    @else
        <div class="table-responsive">
            <table class="table table-striped table-hover text-center align-middle shadow rounded-4">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Rol</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach($usuarios as $index => $usuario)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $usuario->name }}</td>
                            <td>{{ $usuario->email }}</td>
                            <td>{{ ucfirst($usuario->role) }}</td>
                            {{ optional($usuario->created_at)->format('d/m/Y') ?? 'Sin fecha' }}

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
