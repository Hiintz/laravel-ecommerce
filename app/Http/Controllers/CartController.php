<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class CartController extends Controller
{
    // Affiche le contenu du panier
    public function index(Request $request)
    {
        $cart = $request->session()->get('cart', []); // Récupère le panier depuis la session

        // Récupère les détails des produits dans le panier avec leur quantité
        $cartWithData = [];
        $total = 0;

        foreach ($cart as $productId => $quantity) {
            $product = Product::findOrFail($productId);
            $total += $product->price * $quantity; // Calcul du total pour chaque produit
            $cartWithData[] = [
                'product' => $product,
                'quantity' => $quantity
            ];
        }

        return view('cart.index', compact('cartWithData', 'total'));
    }

    // Ajoute un produit au panier
    public function add(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'quantity' => 'required|integer|min:1', // Valide que la quantité est un entier positif
        ]);

        $quantity = $request->input('quantity');

        $cart = $request->session()->get('cart', []);

        // Augmente la quantité du produit s'il est déjà dans le panier, sinon initialise à la quantité spécifiée
        if (isset($cart[$product->id])) {
            $cart[$product->id] += $quantity;
        } else {
            $cart[$product->id] = $quantity;
        }

        $request->session()->put('cart', $cart);

        return redirect()->route('cart.index')->with('success', 'Produit ajouté au panier avec succès.');
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'quantity' => 'required|integer|min:1', // Valide que la quantité est un entier positif
        ]);

        $quantity = $request->input('quantity');

        $cart = $request->session()->get('cart', []);

        // Met à jour la quantité du produit dans le panier
        if ($quantity > 0) {
            $cart[$product->id] = $quantity;
        } else {
            unset($cart[$product->id]);
        }

        $request->session()->put('cart', $cart);

        return redirect()->route('cart.index')->with('success', 'Panier mis à jour avec succès.');
    }

    public function remove(Request $request, $id)
    {
        $cart = $request->session()->get('cart', []);

        unset($cart[$id]);

        $request->session()->put('cart', $cart);

        return redirect()->route('cart.index')->with('success', 'Produit retiré du panier avec succès.');
    }

    public function clear(Request $request)
    {
        $request->session()->forget('cart');

        return redirect()->route('cart.index')->with('success', 'Panier vidé avec succès.');
    }

    public function validateCart(Request $request)
    {
        $request->validate([
            'delivery_location' => 'required|string',
            'postal_code' => 'required|string',
            'city' => 'required|string',
            'payment_method' => 'required|in:CB,Paypal,Virement bancaire',
        ]);

        $cart = $request->session()->get('cart', []);
        $total = 0;

        // Calcul du total du panier
        foreach ($cart as $productId => $quantity) {
            $product = Product::findOrFail($productId);
            $total += $product->price * $quantity;
        }

        // Enregistrement de la commande
        $order = new Order();
        $order->delivery_location = $request->input('delivery_location');
        $order->postal_code = $request->input('postal_code');
        $order->city = $request->input('city');
        $order->payment_method = $request->input('payment_method');
        $order->amount = $total;
        $order->status = 'pending'; // Par défaut, à adapter selon vos besoins
        $order->save();

        // Vider le panier après validation
        $request->session()->forget('cart');

        // Redirection avec message de succès
        return redirect()->route('cart.index')->with('success', 'Commande validée avec succès.');
    }

}
