<?php

namespace App\Http\Controllers;

use App\Models\Carousel;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MainController extends Controller
{
  public function landing()
  {
      return view('landing');
  }

    public function home()
{
    $carousel = Carousel::all();
    $products = Product::where('is_active', true)

    ->whereHas('category', function($q){

        $q->where('is_active', true);

    })

    ->where(function($query){

        $query->where('best_seller', true)
              ->orWhereNotNull('sale_percent');

    })

    ->orderByDesc('best_seller')

    ->latest()

    ->paginate(8);
    $categories = Category::where('is_active', true)->get();  


    return view('home', compact('carousel', 'products', 'categories'));
}

public function product(Product $product)
{
    $product->load('category');

    if (!$product->is_active || !$product->category || !$product->category->is_active) {
        abort(404);
    }

    $recommended = $product->category->products()

    ->where('is_active', true)

    ->whereKeyNot($product->id)

    ->where(function($query){

        $query->where('best_seller', true)
              ->orWhereNotNull('sale_percent');

    })

    ->inRandomOrder()

    ->take(4)

    ->get();

    return view('product', compact('product', 'recommended'));
}
public function products(Request $request)
{
    $query = Product::where('is_active', true)
        ->whereHas('category', function($q){
            $q->where('is_active', true);
        });

    if($request->category){
        $query->where('category_id', $request->category);
    }

    if($request->min_price){
        $query->where('price', '>=', $request->min_price);
    }

    if($request->max_price){
        $query->where('price', '<=', $request->max_price);
    }

    $products = $query->paginate(8)->withQueryString();

    $categories = Category::where('is_active', true)->get();

    return view('products', compact('products', 'categories'));
}
public function search(Request $request){

    $query = $request->q;

    $products = Product::where('is_active', true)
        ->whereHas('category', function($q){
            $q->where('is_active', true);
        })
        ->where(function($q2) use ($query){
            $q2->where('name', 'like', "%$query%")
               ->orWhere('description', 'like', "%$query%");
        })
        ->get();

    return view('search', compact('products', 'query'));
}

public function contact()
{
    return view('contact');

}

public function chatbot(Request $request)
{
    $userMessage = $request->message;

    // 🔥 Get products (limit to avoid overload)
    $products = Product::where('is_active', true)
        ->take(10)
        ->get(['name', 'price', 'description']);

    // Convert to text
    $productList = "";

    foreach ($products as $product) {
        $productList .= "{$product->name} - \${$product->price} - {$product->description}\n";
    }

    $response = Http::withHeaders([
        'Authorization' => 'Bearer ' . env('OPENAI_API_KEY'),
        'Content-Type' => 'application/json',
    ])->post('https://api.openai.com/v1/chat/completions', [
        'model' => 'gpt-4o-mini',
        'messages' => [
            [
                'role' => 'system',
                'content' => "You are a helpful assistant for an ecommerce website called J Shop.

Here are some products available:
$productList

Use this information to answer user questions and recommend products."
            ],
            [
                'role' => 'user',
                'content' => $userMessage
            ]
        ]
    ]);

    return response()->json([
        'reply' => $response['choices'][0]['message']['content']
    ]);
}
}