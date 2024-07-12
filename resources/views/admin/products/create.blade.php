@extends('main')

@section('content')
<div class="container mt-5">
    <h2>Ajouter un nouveau produit</h2>
    <form action="{{ route('admin.products.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Nom :</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="description">Description :</label>
            <textarea name="description" id="description" class="form-control" required></textarea>
        </div>
        <div class="form-group">
            <label for="price">Prix :</label>
            <input type="text" name="price" id="price" class="form-control" required>
        </div>
        <div class="mb-3 form-check">
            <input type="hidden" name="promotion" value="0"> 
            <input type="checkbox" class="form-check-input" id="promotion" name="promotion" value="1"> 
            <label class="form-check-label" for="promotion">En promotion</label>
        </div>
        <div class="form-group">
            <label for="image">Image (URL) :</label>
            <input type="text" name="image" id="image" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="category_id">Catégorie :</label>
            <select name="category_id" id="category_id" class="form-control" required>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Ajouter</button>
    </form>
</div>
@endsection
