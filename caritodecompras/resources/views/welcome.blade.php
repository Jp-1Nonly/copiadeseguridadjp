<!-- resources/views/welcome.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mt-5 mb-4 text-center">Bienvenido</h1>
        
        <nav class="mb-5">
            <ul class="list-inline text-center">
                <li class="list-inline-item">
                    <a href="{{ url('/productos') }}" class="btn btn-primary btn-lg">Productos</a>
                </li>
                <li class="list-inline-item">
                    <a href="{{ url('/carrito') }}" class="btn btn-success btn-lg">Carrito de Compras</a>
                </li>
                <li class="list-inline-item">
                    <a class="btn btn-primary btn-lg" href="{{ route('pedidos.index') }}">Ver Lista de Pedidos</a>
                </li>
            </ul>
        </nav>
    </div>
@endsection
