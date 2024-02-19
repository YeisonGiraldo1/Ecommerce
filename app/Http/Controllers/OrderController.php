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


class OrderController extends Controller
{
    public function orderconfirmation(Order $order)
{

    $order = Order::find($order->id); 
    $orderitem = OrderItem::where("order_id",$order->id)->get();
    return view('orders.confirmation', compact('order','orderitem'));
}


public function allorders(){
    $allorders = Order::all();
    return view('orders.index', compact('allorders'));
}

}
