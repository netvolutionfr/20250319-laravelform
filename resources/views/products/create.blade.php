<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un Produit</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container mt-5">
<h2>Créer un nouveau produit</h2>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label for="name" class="form-label">Nom du produit</label>
        <input type="text" class="form-control" id="name" name="name" required>
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
    </div>

    <div class="mb-3">
        <label for="price" class="form-label">Prix (€)</label>
        <input type="number" step="0.01" class="form-control" id="price" name="price" required>
    </div>

    <div class="mb-3">
        <label for="image" class="form-label">Image</label>
        <input type="file" class="form-control" id="image" name="image" required>
    </div>

    <div class="mb-3">
        <label for="pdf" class="form-label">PDF</label>
        <input type="file" class="form-control" id="pdf" name="pdf">
    </div>

    <button type="submit" class="btn btn-primary">Enregistrer</button>
</form>
</body>
</html>
