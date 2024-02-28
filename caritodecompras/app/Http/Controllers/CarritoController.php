<?php

// app/Http/Controllers/CarritoController.php

// app/Http/Controllers/CarritoController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetallePedido;
use App\Models\ficha;
use App\Models\profesore;
use App\Models\Producto;
use App\Models\Pedido;




class CarritoController extends Controller
{
    public function index()
    {
        $ficha = ficha::all();
        $profesor = profesore::all();
        $cart = session()->get('cart', []);
        return view('productos.carrito', compact('cart','ficha','profesor'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'cantidad' => 'required|numeric|min:1',
        ]);

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['cantidad'] = $request->input('cantidad');
            session(['cart' => $cart]);
        }

        return redirect('/carrito')->with('success', 'Carrito actualizado');
    }

    public function checkout()
    {
        // Lógica para realizar el pedido
        // Puedes implementar esto según tus necesidades

        // Limpiar el carrito después de realizar el pedido
        session()->forget('cart');

        return redirect('/')->with('success', 'Pedido realizado exitosamente');
    }

    public function clearCart()
    {
        // Limpiar todo el carrito
        session()->forget('cart');

        return redirect('/carrito')->with('success', 'Carrito vaciado');
    }

    public function removeItem($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session(['cart' => $cart]);
        }

        return redirect('/carrito')->with('success', 'Producto eliminado del carrito');
    }

    public function addDiscount(Request $request)
    {
        $request->validate([
            'descuento' => 'required|numeric|min:0|max:100',
        ]);

        $descuento = $request->input('descuento');
        session(['descuento' => $descuento]);

        return redirect('/carrito')->with('success', 'Descuento aplicado al carrito');
    }

    public function removeDiscount()
    {
        session()->forget('descuento');

        return redirect('/carrito')->with('success', 'Descuento eliminado del carrito');
    }



    public function procesarPedido(Request $request)
    {
        // Validaciones y demás lógica...

        // Crear el pedido
        $pedido = new Pedido();
        $pedido->ficha_id = $request->input('ficha');
        $pedido->profesor_id = $request->input('profesor');
        $pedido->total = array_sum(array_map(function ($item) {
            return $item['precio'] * $item['cantidad'];
        }, session('cart')));
        $pedido->save();

        // Obtener el ID del pedido recién creado
        $pedidoId = $pedido->id;

        // Crear los detalles de pedido
        foreach (session('cart') as $id => $item) {
            $detallePedido = new DetallePedido();
            $detallePedido->pedido_id = $pedidoId;
            $detallePedido->producto_id = $id;
            $detallePedido->cantidad = $item['cantidad'];
            $detallePedido->precio_unitario = $item['precio'];
            $detallePedido->total = $item['precio'] * $item['cantidad'];
            $detallePedido->save();
        }

        // Limpiar el carrito después de procesar el pedido
        session(['cart' => []]);

        // Redireccionar o mostrar mensajes según sea necesario
        return redirect()->route('home');
    }



}


