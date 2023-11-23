<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Inertia\Inertia;
use Inertia\Response;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return Inertia::render('Dashboard', [
            'products' => $products,
        ]);
    }

    public function create()
    {
        return Inertia::render('Products/NewProduct');
    }

    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $promotionalPrice = $request->price * (1- ($request->saving/100));
        $imageName = time().'.'.$request->image->extension();

        $request->image->move(public_path('images'), $imageName);


        Product::create([
            'name' => $request->name,
            'original_price' => $request->price,
            'promotional_price' => $promotionalPrice,
            'saving' => $request->saving,
            'size' => $request->size,
            'image_filename' => $imageName,
        ]);

        return redirect()->route('dashboard')->with('success', 'Product created successfully!');
    }

    public function edit(Product $product)
    {
        return Inertia::render('Products/EditProduct', [
            'product' => $product,
        ]);
    }

    public function update(Request $request, Product $product)
    {
        // dd($request->all());
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:2048',
        ]);

        $promotionalPrice = $request->price * (1 - ($request->saving / 100));

        //check if there was an image upload
        if (!$request->hasFile('image')) {
            $product->update([
                'name' => $request->name,
                'original_price' => $request->price,
                'promotional_price' => $promotionalPrice,
                'saving' => $request->saving,
                'size' => $request->size,
            ]);
        }
        else {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);

            // Update only the image
            $product->update([
                'name' => $request->name,
                'original_price' => $request->price,
                'promotional_price' => $promotionalPrice,
                'saving' => $request->saving,
                'size' => $request->size,
                'image_filename' => $imageName
            ]);
        }

        return redirect()->route('dashboard')->with('success', 'Product updated successfully!');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('dashboard')->with('success', 'Product deleted successfully!');
    }
}
