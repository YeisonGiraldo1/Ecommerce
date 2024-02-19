<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Address;


use App\Models\Order;
use App\Models\OrderItem;

class CheckoutController extends Controller
{
    public function index()
    {
        $userId = auth()->user()->id;

        $data['users'] = User::select([
            'name',
            'email'
        ])->where('id' ,$userId)->get();

// GET USER ADDRESS

        $data['address'] = Address::select([
            'department',
            'city',
            'neighborhood'
        ])->where('user_id' ,$userId)->get();


        $data['items'] = Cart::select([
            'carts.id',
            'products.name',
            // Selecciona el precio con descuento si el descuento es mayor a 0, de lo contrario, selecciona el precio original
            \DB::raw('CASE WHEN products.discount > 0 THEN products.price - (products.price * (products.discount / 100)) ELSE products.price END as price'),
            'products.image',
            'carts.quantity'

        ])->join('products', 'products.id', '=', 'carts.product_id')
        ->where('carts.user_id', $userId)->get();

        $data['cart'] = Cart::join('products', 'products.id', '=', 'carts.product_id')
        ->where('carts.user_id', $userId)->count();

        $data['addition'] = Cart::join('products', 'products.id', '=', 'carts.product_id')
        ->where('carts.user_id', $userId)->sum('products.price');

        $data['total'] = 0;
        foreach($data['items'] as $value){
            $data['total'] += $value->price * $value->quantity;
        }


        return view('checkout.index',$data);
    
    }

    public function placeOrder(Request $request)
    {
        // Obtener datos del formulario
        
    
        $address_id = 13;
        // Obtener los elementos del carrito
        $cartItems = Cart::where('user_id', auth()->user()->id)->get();
    
        // Calcular el total automáticamente
        $total = 0;
    
        foreach ($cartItems as $item) {
            $product = $item->product;
    
            // Calcular el precio del producto teniendo en cuenta el descuento si es aplicable
            $productPrice = $product->discount > 0 ? $product->price - ($product->price * ($product->discount / 100)) : $product->price;
    
            // Sumar al total multiplicando por la cantidad
            $total += $productPrice * $item->quantity;
        }
    
        // Crear una nueva orden
        $order = new Order();
        $order->user_id = auth()->user()->id;
        $order->address_id = $address_id;     
        $order->total = $total;
        $order->status = 'pending';
        $order->save();
    
        // Agregar detalles del pedido (productos)
        foreach ($cartItems as $item) {
            $orderItem = new OrderItem();
            $orderItem->order_id = $order->id;
            $orderItem->product_id = $item->product_id;
            $orderItem->quantity = $item->quantity;
    
            // Utilizar el mismo cálculo para el precio del producto
            $orderItem->price = $item->product->discount > 0 ? $item->product->price - ($item->product->price * ($item->product->discount / 100)) : $item->product->price;
    
            $orderItem->save();
        }
    
        // Limpiar carrito después de realizar el pedido
        Cart::where('user_id', auth()->user()->id)->delete();


      
        //RESTAR STOCK DE PRODUCTOS QUE SE VENDERON EN ESE PED

        $product = Product::find($item->product_id);
        $product->stock -= $item->quantity;
        $product->save();
    
        // Redirigir a una página de confirmación o mostrar un mensaje
        return redirect()->route('order.confirmation',$order->id)->with('success', '¡Pedido realizado con éxito!');
    }
    

 
    public function __construct()
    {
        $this->middleware('web');
    }
}
