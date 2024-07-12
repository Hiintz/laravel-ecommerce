@extends('main')

@section('content')
<div class="container mt-5">
    <h2>Panier</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(empty($cartWithData))
        <p>Votre panier est vide.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Produit</th>
                    <th>Quantité</th>
                    <th>Prix unitaire</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cartWithData as $item)
                    <tr>
                        <td>{{ $item['product']->name }}</td>
                        <td>
                            <form action="{{ route('cart.update', ['id' => $item['product']->id]) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" required>
                                <button type="submit" class="btn btn-primary">Mettre à jour</button>
                            </form>
                        </td>
                        <td>{{ $item['product']->price }} €</td>
                        <td>{{ $item['quantity'] * $item['product']->price }} €</td>
                        <td>
                            <a href="{{ route('cart.remove', ['id' => $item['product']->id]) }}" class="btn btn-danger">Supprimer</a>
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="3" class="text-end"><strong>Total</strong></td>
                    <td><strong>{{ $total }} €</strong></td>
                    <td></td> <!-- Colonne vide pour aligner avec les actions -->
                </tr>
            </tbody>
        </table>

        <div class="text-end">
            <a href="{{ route('cart.clear') }}" class="btn btn-danger">Vider le panier</a>
            <a href="{{ route('cart.validate') }}" class="btn btn-primary">Valider le panier</a>
            
        </div>
    @endif
</div>
@endsection
