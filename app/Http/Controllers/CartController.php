<?php

namespace App\Http\Controllers;

use App\Models\Product;

class CartController extends Controller
{
    public function index()
    {
        $cart = session('cart', []);

        return view('cart', compact('cart'));
    }

    public function add(Product $product)
    {
        if (!$product->is_active || !$product->category?->is_active) {
            return back()->with('error', 'Product unavailable.');
        }

        $cart = session('cart', []);

        $currentQty = $cart[$product->id]['quantity'] ?? 0;

        if ($currentQty >= $product->stock) {
            return back()->with('error', 'No more stock available.');
        }

        $cart[$product->id] = [
            'name'     => $product->name,
            'price'    => $product->price,
            'image'    => $product->image,
            'quantity' => $currentQty + 1,
        ];

        session()->put('cart', $cart);

        return back()->with('success', 'Product added to cart.');
    }

    public function remove(Product $product)
    {
        $cart = session('cart', []);

        unset($cart[$product->id]);

        session()->put('cart', $cart);

        return back()->with('success', 'Product removed.');
    }

    public function increase(Product $product)
    {
        $cart = session('cart', []);

        if (!isset($cart[$product->id])) {
            return back();
        }

        if ($cart[$product->id]['quantity'] >= $product->stock) {
            return back()->with('error', 'Stock limit reached.');
        }

        $cart[$product->id]['quantity']++;

        session()->put('cart', $cart);

        return back();
    }

    public function decrease(Product $product)
    {
        $cart = session('cart', []);

        if (!isset($cart[$product->id])) {
            return back();
        }

        $cart[$product->id]['quantity']--;

        if ($cart[$product->id]['quantity'] <= 0) {
            unset($cart[$product->id]);
        }

        session()->put('cart', $cart);

        return back();
    }
}