<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un Produit</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container mt-5">
<h2>Liste des produits</h2>
<a href="{{ route('products.create') }}" class="btn btn-primary mb-3">Ajouter un produit</a>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-striped table-bordered">
    <thead class="table-dark">
    <tr>
        <th>ID</th>
        <th>Nom</th>
        <th>Description</th>
        <th>Prix (€)</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    @foreach($products as $product)
        <tr>
            <td>{{ $product->id }}</td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->description }}</td>
            <td>{{ number_format($product->price, 2, ',', ' ') }} €</td>
            <td>
                <a href="#" class="btn btn-info btn-sm">Modifier</a>
                <a href="#" class="btn btn-danger btn-sm">Supprimer</a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

@if($products->isEmpty())
    <p class="text-center text-muted">Aucun produit disponible.</p>
@endif

</body>
</html>
