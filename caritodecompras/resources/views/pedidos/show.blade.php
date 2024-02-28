<!-- resources/views/pedidos/show.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mt-5">Detalles del Pedido</h1>

        <!-- Mostrar detalles del pedido -->
        <p><strong>ID del Pedido:</strong> {{ $pedido->id }}</p>
        <p><strong>Ficha:</strong> {{ $pedido->ficha->ficha }} - {{ $pedido->ficha->nombre }}</p>
        

        <h2>Productos:</h2>
        @foreach ($pedido->detalles as $detalle)
            <p><strong>Producto:</strong> 
                @if ($detalle->producto)
                    {{ $detalle->producto->nombre }}
                    
                @else
                    Producto no disponible
                @endif
            </p>
            <p><strong>Cantidad:</strong> {{ $detalle->cantidad }}</p>
            <p><strong>Precio unidad:</strong>{{ $detalle->producto->precio }}</p>
            <!-- Puedes mostrar más detalles del producto según sea necesario -->
            <hr>
        @endforeach
    </div>
@endsection
