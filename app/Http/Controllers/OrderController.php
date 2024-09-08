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


public function orderdetail(Order $order)
{
    $order = Order::find($order->id);
    $orderdetail = OrderItem::where("order_id",$order->id)->get();

    // Acceder al usuario asociado con el pedido
    $user = $order->user;
    $address = $order->address;


    return view("orders.detail", compact("order","orderdetail","user","address"));
}



//ORDER USER

public function userorders()
{
    $userId = Auth::id();
    $orders = Order::where("user_id",$userId)->get();  
    return view('orders.userorders', ['orders' => $orders]); 
}


public function userorderdetail($orderId)
{
    $order = Order::find($orderId);
    $orderdetail = OrderItem::where('order_id',$orderId)->get();

    return view("orders.userorderdetail", compact("order","orderdetail"));
}
}
