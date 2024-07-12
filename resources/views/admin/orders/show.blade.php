@extends('main')

@section('content')
<div class="container mt-5">
    <h2>Détails de la commande</h2>
    <div class="card mb-3">
        <div class="card-header">
            Commande #{{ $order->id }}
        </div>
        <div class="card-body">
            <h5 class="card-title">Détails de la commande</h5>
            <p><strong>Lieu de livraison:</strong> {{ $order->delivery_location }}, {{ $order->postal_code }}, {{ $order->city }}</p>
            <p><strong>Méthode de paiement:</strong> {{ $order->payment_method }}</p>
            <p><strong>Total:</strong> {{ $order->amount }} €</p>
            <p><strong>Date de commande:</strong> {{ $order->created_at->format('d/m/Y H:i:s') }}</p>
            <p><strong>Statut:</strong> {{ $order->status }}</p>
        </div>
    </div>
    <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">Retour</a>
</div>
@endsection
