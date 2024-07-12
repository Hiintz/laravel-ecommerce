@extends('main')

@section('content')
<div class="container mt-5">
    <h2>Modifier la Catégorie</h2>
    <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
        @csrf
        @method('PATCH')
        <div class="form-group">
            <label for="name">Nom de la catégorie :</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $category->name }}" required>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Modifier</button>
    </form>
</div>
@endsection
