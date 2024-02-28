<!-- resources/views/productos/index.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mt-5 mb-4 text-center">Lista de Productos</h1>

        <div class="text-left mt-4">
            <a href="{{ url()->previous() }}" class="btn btn-danger">Volver</a>
            <a href="{{ url('/carrito') }}" class="btn btn-info ml-2">Ver Carrito</a>
        </div>

        <div class="row">
            @foreach ($productos as $producto)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title">{{ $producto->nombre }}</h3>
                            <p class="card-text">Precio: ${{ $producto->precio }}</p>
                            <form action="{{ url('/add-to-cart', $producto->id) }}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-primary">Agregar al Carrito</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
