<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();
        $products = Product::query();

        // Filtrage par catégorie
        if ($request->has('category') && $request->category != 'all') {
            $products->where('category_id', $request->category);
        }

        // Tri des produits
        if ($request->has('sort')) {
            switch ($request->sort) {
                case 'price_asc':
                    $products->orderBy('price', 'asc');
                    break;
                case 'price_desc':
                    $products->orderBy('price', 'desc');
                    break;
                case 'name_asc':
                    $products->orderBy('name', 'asc');
                    break;
                case 'name_desc':
                    $products->orderBy('name', 'desc');
                    break;
            }
        }

        $products = $products->get();

        return view('products.index', compact('products', 'categories'));
    }

    // Méthode pour afficher les détails d'un produit
    public function show($id)
    {
        $product = Product::findOrFail($id); // Récupère le produit par son ID

        return view('products.show', compact('product'));
    }
}
