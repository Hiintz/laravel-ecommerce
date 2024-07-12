@extends('main')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-4">
            <img src="{{ $product->image }}" class="img-fluid rounded" alt="{{ $product->name }}">
        </div>
        <div class="col-md-8">
            <h2>{{ $product->name }}</h2>
            <p><strong>Prix :</strong> {{ $product->price }} €</p>
            <p><strong>Description :</strong> {{ $product->description }}</p>
            <p><strong>Catégorie :</strong> {{ $product->category->name }}</p>

            <form action="{{ route('cart.add', ['id' => $product->id]) }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="quantity">Quantité :</label>
                    <input type="number" id="quantity" name="quantity" class="form-control" value="1" min="1">
                </div>
                <button type="submit" class="btn btn-primary">Ajouter au panier</button>
            </form>
        </div>
    </div>
</div>
@endsection
