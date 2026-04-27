<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Carousel;
use App\Models\Product;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\Order;
use Illuminate\Support\Facades\File;

class AdminController extends Controller
{
    function main(){
        return view('admin.main');
    }

    function users(){
        $users = User::all();
        return view('admin.users', compact('users'));
    }

     function toggleRole(User $user){
      $user->role == 'admin'? $user->role='user' : $user->role='admin';
      $user->save();
      return redirect()->back();
     }

    function deleteUser(User $user)
{
    if ($user->orders()->exists()) {
        return back()->with('error', 'Cannot delete user with existing orders.');
    }

    $user->delete();

    return back()->with('success', 'User deleted');
}

      function carouselPage(){
         $carousels = Carousel::all();
    return view('admin.carousel', compact('carousels'));
}
     
     function carouselUpload(Request $request){
      $fields = $request->validate([
       'title'=> ['required','min:1','max:255'],
       'description'=> ['required','min:1','max:255'],
       'pic'=>['required', 'image','mimes:jpg,png,gif,jpeg','max:1024']
      ]);

      $image_name= Str::uuid() . "." . $fields['pic']->extension();

      $fields['pic']->move(public_path('assets/images'),$image_name);
      $fields['pic'] = $image_name;

      Carousel::create($fields);
      return redirect()->back();
     }

     function editCarousel(Carousel $carousel){
    return view('admin.edit-carousel', compact('carousel'));
}

function updateCarousel(Request $request, Carousel $carousel){

    $fields = $request->validate([
        'title' => 'required',
        'description' => 'required',
        'pic' => 'nullable|image'
    ]);

    // if new image uploaded
    if($request->hasFile('pic')){

        // delete old image
        if(File::exists(public_path('assets/images/' . $carousel->pic))){
            File::delete(public_path('assets/images/' . $carousel->pic));
        }

        $imageName = Str::uuid() . '.' . $request->pic->extension();
        $request->pic->move(public_path('assets/images'), $imageName);

        $fields['pic'] = $imageName;
    }

    $carousel->update($fields);

    return redirect()->route('admin.carousel')->with('success', 'Slide updated');
}

function deleteCarousel(Carousel $carousel){

    // delete image
    if(File::exists(public_path('assets/images/' . $carousel->pic))){
        File::delete(public_path('assets/images/' . $carousel->pic));
    }

    $carousel->delete();

    return back()->with('success', 'Slide deleted');
}

     function adminProducts(){
    $products = Product::all();
    $categories = Category::where('is_active', true)->get();
    return view('admin.products', compact('products', 'categories'));
}

function storeProduct(Request $request){
    $fields = $request->validate([
        'name' => 'required',
        'description' => 'required',
        'price' => 'required|numeric',
        'image' => 'required|image',
        'category_id' => 'required|exists:categories,id',
        'stock' => 'required|integer|min:0'
    ]);

    $imageName = Str::uuid() . '.' . $request->image->extension();
    $request->image->move(public_path('assets/images'), $imageName);

    $fields['image'] = $imageName;

    Product::create($fields);

    return back()->with('success', 'Product added successfully.');
}

function toggleProduct(Product $product){
    $product->is_active = !$product->is_active;
    $product->save();

    return back()->with('success', 'Product status updated');
}

function editProduct(Product $product){
    $categories = Category::where('is_active', true)->get();

    return view('admin.edit-product', compact('product', 'categories'));
}

function updateProduct(Request $request, Product $product){

    $fields = $request->validate([
        'name' => 'required',
        'description' => 'required',
        'price' => 'required|numeric',
        'stock' => 'required|integer|min:0',
        'category_id' => 'required|exists:categories,id',
        'image' => 'nullable|image'
    ]);

    // 🖼️ handle new image (optional)
    if($request->hasFile('image')){
        $imageName = Str::uuid() . '.' . $request->image->extension();
        $request->image->move(public_path('assets/images'), $imageName);

        $fields['image'] = $imageName;
    }

    $product->update($fields);

    return redirect()->route('admin.products')->with('success', 'Product updated');
}

function categories(){
    $categories = Category::all();
    return view('admin.categories', compact('categories'));
}

 function storeCategory(Request $request)
{
    $fields = $request->validate([
        'name' => 'required|unique:categories,name'
    ]);

    Category::create($fields);

    return back();
}

function toggleCategory(Category $category){
    $category->is_active = !$category->is_active;
    $category->save();

    return back();
}

function orders(){

    $orders = Order::with('items.product', 'user')
        ->latest()
        ->get();

    return view('admin.orders', compact('orders'));
}

function updateOrderStatus(Request $request, Order $order)
{
    $fields = $request->validate([
        'status' => 'required|in:pending,shipped,delivered'
    ]);

    $order->update($fields);

    return back()->with('success', 'Order status updated.');
}

}
