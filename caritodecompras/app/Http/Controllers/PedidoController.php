<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedido;
use App\Models\DetallePedido;

class PedidoController extends Controller
{
    public function index()
    {
        $pedidos = Pedido::all();
        return view('pedidos.index', compact('pedidos'));
    }

    public function show($id)
    {
        $pedido = Pedido::with('ficha', 'detalles.producto')->findOrFail($id);
        return view('pedidos.show', compact('pedido'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'ficha' => 'required',
            'profesor' => 'required',
            // Otros campos según tus necesidades
        ]);

        Pedido::create($request->all());

        // Limpia el carrito después de realizar el pedido
        session()->forget('cart');

        // Redirige a una página de confirmación o a donde desees
        return redirect('/confirmacion')->with('success', 'Pedido realizado con éxito.');
    }
}
