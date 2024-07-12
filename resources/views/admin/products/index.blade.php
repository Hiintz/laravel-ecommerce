@extends('main')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12 mb-3">
            <a href="{{ route('admin.orders.index') }}" class="btn btn-primary">Voir toutes les commandes</a>
            <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Gérer les Catégories</a>
            <a href="{{ route('profile.edit') }}" class="btn btn-primary">Modifier mon profil</a>
        </div>
    </div>
    <h2>Liste des produits</h2>
    <a href="{{ route('admin.products.create') }}" class="btn btn-primary mb-3">Ajouter un produit</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Description</th>
                <th>Prix</th>
                <th>Catégorie</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->description }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->category->name }}</td>
                    <td>
                        <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-warning">Modifier</a>
                        <form action="{{ route('admin.products.destroy', $product) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
