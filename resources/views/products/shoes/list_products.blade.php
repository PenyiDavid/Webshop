<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Document</title>
</head>
<body>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="container mt-5">
        <h1 class="mb-4">Ruhabolt Szűrő</h1>

        <form method="GET" action="{{ route('products.clothes_index') }}">
            <div class="row">
                <!-- Ár szűrő -->
                <div class="col-md-3 mb-3">
                    <label for="min_price">Ár (tól):</label>
                    <input type="number" name="min_price" id="min_price" class="form-control" placeholder="Min ár" value="{{ request()->min_price }}">
                </div>

                <div class="col-md-3 mb-3">
                    <label for="max_price">Ár (ig):</label>
                    <input type="number" name="max_price" id="max_price" class="form-control" placeholder="Max ár" value="{{ request()->max_price }}">
                </div>

                <!-- Név vagy modell szűrő -->
                <div class="col-md-3 mb-3">
                    <label for="name">Brand:</label>
                    <input type="text" name="brand" id="brand" class="form-control" placeholder="Cipő márkája" value="{{ request()->brand }}">
                </div>
                <div class="col-md-3 mb-3">
                    <label for="name">Modell:</label>
                    <input type="text" name="modell" id="modell" class="form-control" placeholder="Cipő modell" value="{{ request()->modell }}">
                </div>

                <!-- Szín szűrő -->
                <div class="col-md-3 mb-3">
                    <label for="color">Szín:</label>
                    <select name="color" id="color" class="form-control">
                        <option value="">Válassz színt</option>
                        <option value="fekete" {{ request()->color == 'fekete' ? 'selected' : '' }}>Fekete</option>
                        <option value="fehér" {{ request()->color == 'fehér' ? 'selected' : '' }}>Fehér</option>
                        <option value="piros" {{ request()->color == 'piros' ? 'selected' : '' }}>Piros</option>
                        <option value="kék" {{ request()->color == 'kék' ? 'selected' : '' }}>Kék</option>
                        <!-- További színek hozzáadhatók -->
                    </select>
                </div>

                <!-- Méret szűrő -->
                <div class="col-md-3 mb-3">
                    <label for="size">Méret:</label>
                    <select name="size" id="size" class="form-control">
                        <option value="">Válassz méretet</option>
                        <option value="36" {{ request()->size == '36' ? 'selected' : '' }}>36</option>
                        <option value="37" {{ request()->size == '37' ? 'selected' : '' }}>37</option>
                        <option value="38" {{ request()->size == '38' ? 'selected' : '' }}>38</option>
                        <option value="39" {{ request()->size == '39' ? 'selected' : '' }}>39</option>
                        <option value="40" {{ request()->size == '40' ? 'selected' : '' }}>40</option>
                        <option value="41" {{ request()->size == '41' ? 'selected' : '' }}>41</option>
                        <option value="42" {{ request()->size == '42' ? 'selected' : '' }}>42</option>
                        <!-- További méretek hozzáadhatók -->
                    </select>
                </div>
            </div>

            <!-- Szűrő gomb -->
            <div class="row">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">Szűrés</button>
                    <a href="{{ route('products.clothes_index') }}" class="btn btn-secondary">Szűrők törlése</a>
                </div>
            </div>
        </form>

        <div class="row mt-4">
            @if($products->isNotEmpty())
                @foreach($products as $product)
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <img src="{{ $product->image }}" class="card-img-top" alt="{{ $product->name }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $product->brand . '-' . $product->modell }}</h5>
                                <p class="card-text">Szín: {{ $product->color }}</p>
                                <p class="card-text">Méret: {{ $product->size }}</p>
                                <p class="card-text">Raktáron: {{ $product->stock }}</p>
                                <p class="card-text">Ár: {{ $product->price }} Ft</p>
                                <form action="{{ route('update_stock', $product->id) }}" method="POST">
                                    @csrf
                                    @method('PUT') <!-- Ezzel PUT metódusnak fogadja el -->
                                
                                    <div class="form-group">
                                        <label for="quantity">Mennyiség:</label>
                                        <input type="number" name="quantity" class="form-control" min="1" placeholder="Mennyit szeretne vásárolni?" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Vásárlás</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-md-12">
                    <p>Nincs találat a megadott szűrők alapján.</p>
                </div>
            @endif
        </div>
    </div>
</body>
</html>