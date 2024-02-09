<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\User;
use App\Models\Category;
use App\Models\Cart;

class CartController extends Controller
{
  


public function addtocart(Request $request, $id)
{
    // Obtén el producto por su ID
    $product = Product::find($id);
  
    // Verifica si el usuario está autenticado
    if (auth()->check()) {
        // Obtén el ID del usuario autenticado
        $userId = auth()->user()->id;

        // Verifica si ya hay un registro en el carrito para este usuario y producto
        $existingCartItem = Cart::where('user_id', $userId)
            ->where('product_id', $product->id)
            ->first();

        // Obtiene la cantidad seleccionada desde el formulario
        $quantity = $request->input('quantity', 1);

        // Si ya existe un registro, incrementa la cantidad
        if ($existingCartItem) {
            $existingCartItem->quantity += $quantity;
            $existingCartItem->save();
        } else {
            // Si no existe, crea un nuevo registro en el carrito
            Cart::create([
                'user_id' => $userId,
                'product_id' => $product->id,
                'quantity' => $quantity,
            ]);
        }

        // Redirige al carrito con un mensaje de éxito
        return redirect()->route('cart.index')->with('success', 'Producto añadido al carrito exitosamente.');
    } else {
        // Si el usuario no está autenticado, redirige a la página de inicio de sesión
        return redirect()->route('login')->with('error', 'Debes iniciar sesión para agregar productos al carrito.');
    }
}




public function index()
{
    $userId = auth()->id(); // Usa el método "id()" directamente para obtener el id del usuario
    $data['items'] = Cart::join('products', 'products.id', '=', 'carts.product_id')
        ->where('carts.user_id', $userId)
        ->select([
            'carts.id',
            'products.name',
            'products.price',
            'carts.quantity',
            'products.image'
        ])
        ->get();

    // Calcula la cantidad total de productos en el carrito
    $data['totalproducts'] = $data['items']->sum('quantity');
    session(['totalproducts' => $data['totalproducts']]);

    $data['emptycart'] = $data['items']->isEmpty();
    $data['itemCount'] = $data['items']->count();
    $data['addition'] = $data['items']->sum('price');
    $data['total'] = $data['items']->sum(function ($item) {
        return $item->price * $item->quantity;
    });

    // view()->share('totalproducts', $data['totalproducts']);
    return view('cart.index', $data);
}



public function delete($id)
{
    $userId = auth()->user()->id;
    Cart::where([
        ['id', '=', $id],
        ['user_id', '=', $userId]
    ])->delete();

    return redirect()->back();

}




public function update($id, $quantity)
{
    // Verifica si el usuario está autenticado
    if (auth()->check()) {
        // Obtén el ID del usuario autenticado
        $userId = auth()->user()->id;

        // Busca el ítem en el carrito
        $cartItem = Cart::where('user_id', $userId)
            ->where('id', $id)
            ->first();

        // Verifica si el ítem existe en el carrito
        if ($cartItem) {
            // Actualiza la cantidad del ítem en el carrito
            $cartItem->quantity = max(0, $quantity); // Asegura que la cantidad no sea negativa
            $cartItem->save();

            // Redirige al carrito con un mensaje de éxito
            return redirect()->route('cart.index')->with('success', 'Cantidad actualizada exitosamente.');
        } else {
            // Redirige al carrito con un mensaje de error si el ítem no se encuentra
            return redirect()->route('cart.index')->with('error', 'Producto no encontrado en el carrito.');
        }
    } else {
        // Si el usuario no está autenticado, redirige a la página de inicio de sesión
        return redirect()->route('login')->with('error', 'Debes iniciar sesión para realizar esta acción.');
    }
}




}
