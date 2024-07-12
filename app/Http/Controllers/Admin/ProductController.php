<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'promotion' => 'nullable|boolean',
            'image' => 'required|url',
            'category_id' => 'required|exists:categories,id',
        ]);

        $isPromotion = $request->input('promotion') === '1' ? 1 : 0;

        Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'promotion' => $isPromotion,
            'image' => $request->image,
            'category_id' => $request->category_id,
        ]);
        return redirect()->route('admin.dashboard')->with('success', 'Produit ajouté avec succès.');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'promotion' => 'nullable|boolean',
            'image' => 'required|url',
            'category_id' => 'required|exists:categories,id',
        ]);

        $isPromotion = $request->input('promotion') === '1' ? 1 : 0;

        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'promotion' => $isPromotion,
            'image' => $request->image,
            'category_id' => $request->category_id,
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Produit mis à jour avec succès.');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.dashboard')->with('success', 'Produit supprimé avec succès.');
    }
}
