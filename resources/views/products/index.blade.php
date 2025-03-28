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
        <th>Image</th>
        <th>PDF</th>
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
                @if($product->image)
                    <img src="/images/{{ $product->image }}" alt="{{ $product->name }}" style="width: 100px;">
                @else
                   &nbsp;
                @endif
            </td>
            <td>
                @if($product->pdf)
                    <a href="/pdfs/{{ $product->pdf }}" target="_blank">Télécharger</a>
                @else
                    &nbsp;
                @endif
            </td>
            <td>
                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-info btn-sm">Modifier</a>
                <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?')">Supprimer</button>
                </form>
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
