<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\DetalleVenta;
use App\Models\Venta;
use Illuminate\Support\Facades\Auth;

class VentaController extends Controller
{
    // Mostrar contenido del carrito
    public function carrito()
    {
        return view('ventas.carrito');
    }

    // Agregar producto al carrito
    public function agregar(Request $request)
    {
        $producto = Producto::findOrFail($request->producto_id);

        $carrito = session()->get('carrito', []);

        if (isset($carrito[$producto->id])) {
            $carrito[$producto->id]['cantidad'] += $request->cantidad;
        } else {
            $carrito[$producto->id] = [
                'id' => $producto->id,
                'nombre' => $producto->nombre,
                'precio' => $producto->precio,
                'cantidad' => $request->cantidad,
            ];
        }

        session()->put('carrito', $carrito);

        return redirect()->route('carrito')->with('success', 'Producto agregado al carrito.');
    }

    // Eliminar producto del carrito
    public function eliminar($id)
    {
        $carrito = session()->get('carrito', []);

        if (isset($carrito[$id])) {
            unset($carrito[$id]);
            session()->put('carrito', $carrito);
        }

        return redirect()->route('carrito')->with('success', 'Producto eliminado del carrito.');
    }

    // Confirmar compra (aquí solo limpia carrito)
    public function confirmarVenta()
    {
        $carrito = session('carrito', []);
        if (empty($carrito)) {
            return redirect()->route('carrito')->with('error', 'Tu carrito está vacío.');
        }

        // ✅ Calculamos el total
        $total = 0;
        foreach ($carrito as $item) {
            $total += $item['precio'] * $item['cantidad'];
        }

        // ✅ Incluimos 'total' al crear la venta
        $venta = Venta::create([
            'user_id' => auth()->id(),
            'total' => $total,
        ]);

        foreach ($carrito as $item) {
            DetalleVenta::create([
                'venta_id' => $venta->id,
                'producto_id' => $item['id'],
                'cantidad' => $item['cantidad'],
                'precio_unitario' => $item['precio'],
                'subtotal' => $item['precio'] * $item['cantidad'],
            ]);
                $producto = Producto::find($item['id']);
                $producto->stock -= $item['cantidad'];
                $producto->save();
        }

        session()->forget('carrito');

        return redirect()->route('boleta.ver', $venta->id)->with('success', '¡Compra registrada con éxito!');
    }


    public function misVentas()
    {
        $ventas = Venta::where('user_id', Auth::id())->with('detalles.producto')->orderBy('created_at', 'desc')->get();
        return view('ventas.misVentas', compact('ventas'));
    }

    public function verBoleta($id)
    {
        $venta = Venta::with('detalles.producto', 'user')->findOrFail($id);

        // Si el usuario no es admin, solo puede ver sus propias ventas
        if (auth()->user()->role !== 'admin' && $venta->user_id !== auth()->id()) {
            abort(403, 'No tienes permiso para ver esta boleta.');
        }

        return view('ventas.boleta', compact('venta'));
    }

    public function todasVentas()
    {
        $ventas = Venta::with('detalles.producto', 'user')->orderBy('created_at', 'desc')->get();
        return view('ventas.todasLasVentas', compact('ventas'));
    }


    public function checkoutForm()
{
    $carrito = session('carrito', []);
    if (empty($carrito)) {
        return redirect()->route('carrito')->with('error', 'Tu carrito está vacío.');
    }
    return view('ventas.checkout');
}

public function procesarPago(Request $request)
{
    // Validación ficticia
    if ($request->cvv === '000') {
        return back()->with('error', 'Pago fallido: CVV inválido.');
    }

    // Si pasa la validación, registrar la venta
    return $this->confirmarVenta(); // Usa el método ya existente
}


public function dashboard()
{
    $ventas = Venta::with('detalles.producto')->get();

    $totalVentas = $ventas->count();
    $ingresosTotales = $ventas->sum('total');

    // Productos más vendidos
    $productosVendidos = [];

    foreach ($ventas as $venta) {
        foreach ($venta->detalles as $detalle) {
            $productoId = $detalle->producto_id;
            $nombre = $detalle->producto->nombre;
            $cantidad = $detalle->cantidad;

            if (!isset($productosVendidos[$productoId])) {
                $productosVendidos[$productoId] = [
                    'nombre' => $nombre,
                    'cantidad' => 0
                ];
            }
            $productosVendidos[$productoId]['cantidad'] += $cantidad;
        }
    }

    // Ordenar por cantidad descendente
    usort($productosVendidos, fn($a, $b) => $b['cantidad'] <=> $a['cantidad']);

    return view('ventas.dashboard', compact(
        'totalVentas',
        'ingresosTotales',
        'productosVendidos',
        'ventas'
    ));
}

}
