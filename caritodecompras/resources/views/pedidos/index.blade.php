@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1 class="mb-4">Lista de Pedidos</h1>

        @if(count($pedidos) > 0)
            <ul class="list-group">
                @foreach($pedidos as $pedido)
                    <li class="list-group-item">
                        <a href="{{ route('pedidos.show', $pedido->id) }}">
                            {{ $pedido->id }} - {{ $pedido->created_at }}
                        </a>
                    </li>
                @endforeach
            </ul>
        @else
            <p class="mt-4">No hay pedidos disponibles.</p>
        @endif
    </div>
@endsection
