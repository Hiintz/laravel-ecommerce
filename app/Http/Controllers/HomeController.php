<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        $promotions = Product::where('promotion', true)->get();
        $categories = Category::all();
        return view('home', compact('promotions', 'categories'));
    }
}
