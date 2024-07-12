@extends('main')

@section('content')
<div class="container mt-5">
    <h2>Gestion des commandes</h2>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Total</th>
                <th>Date de commande</th>
                <th>Statut</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->amount }} €</td>
                    <td>{{ $order->created_at->format('d/m/Y H:i:s') }}</td>
                    <td>{{ $order->status }}</td>
                    <td>
                        <form action="{{ route('admin.orders.update', $order->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <select name="status" class="form-select" onchange="this.form.submit()">
                                <option value="pending" @if($order->status == 'pending') selected @endif>En attente</option>
                                <option value="processed" @if($order->status == 'processed') selected @endif>Traitée</option>
                            </select>
                        </form>
                    </td>
                    <td>
                        <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-primary">Voir détails</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
