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



use Illuminate\Validation\Rule;

use Illuminate\Support\Facades\Mail;
use App\Mail\OrderConfirmationMail;

class CheckoutController extends Controller
{
    public function index()
    {
        $userId = auth()->user()->id;
    
        // Obtener datos del usuario
        $data['users'] = User::select(['name', 'email'])
            ->where('id', $userId)
            ->get();
    
       
        // Obtener dirección del usuario
    $data['address'] = Address::select(['id', 'department', 'city', 'neighborhood'])
    ->where('user_id', $userId)
    ->get();  
    
        // Obtener productos en el carrito
        $data['items'] = Cart::select([
            'carts.id',
            'products.name',
            // Selecciona el precio con descuento si el descuento es mayor a 0, de lo contrario, selecciona el precio original
            \DB::raw('CASE WHEN products.discount > 0 THEN products.price - (products.price * (products.discount / 100)) ELSE products.price END as price'),
            'products.image',
            'carts.quantity'
        ])->join('products', 'products.id', '=', 'carts.product_id')
            ->where('carts.user_id', $userId)
            ->get();
    
        // Obtener información del carrito
        $data['cart'] = Cart::join('products', 'products.id', '=', 'carts.product_id')
            ->where('carts.user_id', $userId)
            ->count();
    
        $data['addition'] = Cart::join('products', 'products.id', '=', 'carts.product_id')
            ->where('carts.user_id', $userId)
            ->sum('products.price');
    
        $data['total'] = 0;
        foreach ($data['items'] as $value) {
            $data['total'] += $value->price * $value->quantity;
        }
    
        return view('checkout.index', $data);
    }

    











    public function placeorder(Request $request)
{
 
    // $request->validate([
    //     'address_id' => 'required|exists:addresses,id',
    //     // ... otras reglas de validación si es necesario
    // ]);

    $address_id = $request->input('address_id');
     
     
        $cartItems = Cart::where('user_id', auth()->user()->id)->get();
    
        $total = 0;
    
        foreach ($cartItems as $item) {
            $product = $item->product;
    
            // Calcular el precio del producto teniendo en cuenta el descuento si es aplicable
            $productPrice = $product->discount > 0 ? $product->price - ($product->price * ($product->discount / 100)) : $product->price;
    
            $total += $productPrice * $item->quantity;
        }
    
  
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
    


        // Envía el correo de confirmación
        $user = auth()->user();
        $orderConfirmationMail = new OrderConfirmationMail($order);
        Mail::to($user->email)->send($orderConfirmationMail);


        // Redirigir a una página de confirmación 
        return redirect()->route('order.confirmation',$order->id)->with('success', '¡Pedido realizado con éxito!');
    }
    

 

}
