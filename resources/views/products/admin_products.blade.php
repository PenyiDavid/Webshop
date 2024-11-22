<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Termékek kezelése</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Admin - Termékek kezelése</h2>

        <!-- Üzenetek megjelenítése -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <div class="row">
            @if($products->isNotEmpty())
                @foreach($products as $product)
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">{{ $product->brand }} - {{ $product->modell }}</h5>
                                <p class="card-text">Szín: {{ $product->color }}</p>
                                <p class="card-text">Méret: {{ $product->size }}</p>
                                <p class="card-text">Készlet: {{ $product->stock }}</p>
                                <p class="card-text">Ár: {{ $product->price }} Ft</p>

                                <!-- Termék törlése -->
                                <form action="{{ route('delete_product', $product->id) }}" method="POST" onsubmit="return confirm('Biztosan törölni szeretné a terméket?');">
                                    @csrf
                                    @method('DELETE') <!-- A DELETE metódust használjuk -->
                                    <button type="submit" class="btn btn-danger">Törlés</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-md-12">
                    <p>Nincs elérhető termék.</p>
                </div>
            @endif
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>