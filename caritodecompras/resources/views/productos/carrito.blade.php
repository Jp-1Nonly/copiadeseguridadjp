<!-- resources/views/productos/carrito.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mt-5">Carrito de Compras</h1>
        <a class="btn btn-primary" href="{{ route('pedidos.index') }}">Ver Lista de Pedidos</a>

        @if(session('cart'))
            <div class="table-responsive">
                <table class="table table-bordered table-hover mt-4">
                    <thead class="thead-dark">
                        <tr>
                            <th>Producto</th>
                            <th>Precio Unitario</th>
                            <th>Cantidad</th>
                            <th>Total</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(session('cart') as $id => $item)
                            <tr>
                                <td>{{ $item['nombre'] }}</td>
                                <td>${{ $item['precio'] }}</td> 
                                <td>
                                    <form action="{{ url('/update-cart', $id) }}" method="post">
                                        @csrf
                                        @method('put')
                                        <div class="input-group">
                                            <input type="number" name="cantidad" value="{{ $item['cantidad'] }}" min="1" class="form-control">
                                            <div class="input-group-append">
                                                <button type="submit" class="btn btn-primary">Actualizar</button>
                                            </div>
                                        </div>
                                    </form>
                                </td>
                                <td>${{ $item['precio'] * $item['cantidad'] }}</td>
                                <td>
                                    <form action="{{ url('/remove-item', $id) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <form action="{{ url('/procesar-pedido') }}" method="post">
                @csrf
            
                <div class="mt-4">
                    <h3>Selecciona una ficha para la factura</h3>
                    <select name="ficha" id="ficha" class="form-control">
                        @foreach ($ficha as $fichas)
                            <option value="{{ $fichas['id'] }}">{{ $fichas['ficha'] }} - {{ $fichas['nombre'] }}</option>
                        @endforeach
                    </select>
                </div>
            
                <div class="mt-4">
                    <h3>Selecciona un profesor para la factura</h3>
                    <select name="profesor" id="profesor" class="form-control">
                        @foreach ($profesor as $profesores)
                            <option value="{{ $profesores['id'] }}">{{ $profesores['nombre'] }}</option>
                        @endforeach
                    </select>
                </div>  
            
                <div class="mt-4">
                    <p>Total de todos los productos: ${{ array_sum(array_map(function ($item) { return $item['precio'] * $item['cantidad']; }, session('cart'))) }}</p>
                    <button type="submit" class="btn btn-success">Realizar Pedido</button>
                </div>
            </form>
            
        @else
            <p class="mt-4">El carrito está vacío</p>
        @endif
    </div>
@endsection
