<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Models\User;

class CheckoutController extends Controller
{
    public function index()
    {
        $userId = auth()->user()->id;

        $data['users'] = User::select([
            'name',
            'email'
        ])->where('id' ,$userId)->get();

        $data['items'] = Cart::select([
            'carts.id',
            'products.name',
            'products.price',
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
}
