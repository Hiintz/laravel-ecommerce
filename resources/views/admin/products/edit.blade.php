@extends('main')

@section('content')
<div class="container mt-5">
    <h2>Modifier le produit</h2>
    <form action="{{ route('admin.products.update', $product->id) }}" method="POST">
        @csrf
        @method('PATCH')
        <div class="form-group">
            <label for="name">Nom du produit :</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $product->name }}" required>
        </div>
        <div class="form-group">
            <label for="description">Description :</label>
            <textarea name="description" id="description" class="form-control" required>{{ $product->description }}</textarea>
        </div>
        <div class="form-group">
            <label for="price" class="form-label">Prix :</label>
            <input type="text" class="form-control" id="price" name="price" value="{{ $product->price }}" required>
        </div> 
        <div class="mb-3 form-check">
            <input type="hidden" name="promotion" value="0"> 
            <input type="checkbox" class="form-check-input" id="promotion" name="promotion" value="1" @if($product->promotion) checked @endif>
            <label class="form-check-label" for="promotion">En promotion</label>
        </div>       
        <div class="form-group">
            <label for="image">Image (URL) :</label>
            <input type="text" name="image" id="image" class="form-control" value="{{ $product->image }}" required>
        </div>
        <div class="form-group">
            <label for="category_id">Catégorie :</label>
            <select name="category_id" id="category_id" class="form-control" required>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" @if($category->id == $product->category_id) selected @endif>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Modifier</button>
    </form>
</div>
@endsection
