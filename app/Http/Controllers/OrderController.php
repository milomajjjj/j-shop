<?php

namespace App\Http\Controllers;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function checkout(){

    $cart = session()->get('cart', []);

    if(empty($cart)){
        return back()->with('error', 'Cart is empty');
    }

    $total = 0;

    // create order
    $order = Order::create([
        'user_id' => Auth::id(),
        'total' => 0
    ]);

   foreach($cart as $id => $item){

    // FINAL PRICE AFTER SALE
    $finalPrice = isset($item['sale_percent'])

        ? $item['price'] -
          ($item['price'] * $item['sale_percent'] / 100)

        : $item['price'];

    // SUBTOTAL
    $subtotal = $finalPrice * $item['quantity'];

    $total += $subtotal;

    // CREATE ORDER ITEM
    $order->items()->create([

        'order_id' => $order->id,

        'product_id' => $id,

        'quantity' => $item['quantity'],

        'price' => $finalPrice

    ]);

    // REDUCE STOCK
    $product = Product::find($id);

    $product->stock -= $item['quantity'];

    $product->save();
}

    // update total
    $order->update(['total' => $total]);

    // clear cart
    session()->forget('cart');

    return redirect()->route('orders.index')->with('success', 'Order placed successfully!');
}

public function index(){

    $orders = Order::with('items.product')
        ->where('user_id', Auth::id())
        ->latest()
        ->get();

    return view('orders', compact('orders'));
}
}
