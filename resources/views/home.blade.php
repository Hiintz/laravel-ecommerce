<?php
use App\Models\Product;
use App\Models\Category;

$promotions = Product::where('promotion', true)->get();
$categories = Category::all();
?>

@extends('main')

@section('content')
    <!-- Carousel -->
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <ol class="carousel-indicators">
            @foreach($promotions as $key => $promotion)
                <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{ $key }}" class="{{ $key == 0 ? 'active' : '' }}"></li>
            @endforeach
        </ol>
        <div class="carousel-inner">
            @foreach($promotions as $key => $promotion)
                <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                    <img src="{{ $promotion->image }}" class="d-block w-100" alt="{{ $promotion->name }}">
                    <div class="carousel-caption d-none d-md-block">
                        <div class="carousel-caption-bg">
                            <h5>{{ $promotion->name }}</h5>
                            <p>{{ $promotion->description }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </a>
    </div>

    <!-- Promotions & Offres spéciales -->
    <div class="container mt-5">
        <h2>Promotions et Offres Spéciales</h2>
        <div class="row">
            @foreach($promotions as $promotion)
                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm">
                        <img src="{{ $promotion->image }}" class="card-img-top" alt="{{ $promotion->name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $promotion->name }}</h5>
                            <p class="card-text">{{ $promotion->description }}</p>
                            <a href="{{ route('products.show', $promotion->id) }}" class="btn btn-primary">Voir plus</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Liens vers les catégories -->
    <div class="container mt-5">
        <h2>Catégories</h2>
        <div class="row">
            @foreach($categories as $category)
                <div class="col-md-3">
                    <a href="{{ route('products.index', ['category' => $category->id]) }}" class="btn btn-outline-primary">{{ $category->name }}</a>
                </div>
            @endforeach
        </div>
    </div>
@endsection 
