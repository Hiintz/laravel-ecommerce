@extends('main')

@section('content')
    <div class="container mt-5">
        <h2>Validation du Panier</h2>

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form action="{{ route('cart.validate') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="delivery_location" class="form-label">Adresse de livraison</label>
                <input type="text" class="form-control" id="delivery_location" name="delivery_location" required>
            </div>

            <div class="mb-3">
                <label for="postal_code" class="form-label">Code postal</label>
                <input type="text" class="form-control" id="postal_code" name="postal_code" required>
            </div>

            <div class="mb-3">
                <label for="city" class="form-label">Ville</label>
                <input type="text" class="form-control" id="city" name="city" required>
            </div>

            <div class="mb-3">
                <label for="payment_method" class="form-label">Moyen de paiement</label>
                <select class="form-select" id="payment_method" name="payment_method" required>
                    <option value="CB">Carte Bancaire (CB)</option>
                    <option value="Paypal">Paypal</option>
                    <option value="Virement bancaire">Virement Bancaire</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Valider la commande</button>
        </form>
    </div>
@endsection
