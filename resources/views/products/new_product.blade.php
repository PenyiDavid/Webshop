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
    <div class="container mt-5">
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
        <h2 class="mb-4">Új Termék Hozzáadása</h2>

        <form action="" method="post">
            @csrf
            <!-- Brand -->
            <div class="form-group">
                <label for="brand">Márka:</label>
                <input type="text" name="brand" id="brand" class="form-control" placeholder="Termék márkája" required>
            </div>

            <!-- Model -->
            <div class="form-group">
                <label for="modell">Modell:</label>
                <input type="text" name="modell" id="modell" class="form-control" placeholder="Termék modellje" required>
            </div>

            <!-- Color -->
            <div class="form-group">
                <label for="color">Szín:</label>
                <select name="color" id="color" class="form-control">
                    <option value="motif">Motívum</option>
                    <option value="black">Fekete</option>
                    <option value="white">Fehér</option>
                    <option value="grey">Szürke</option>
                    <option value="blue">Kék</option>
                    <option value="red">Piros</option>
                </select>
            </div>

            <!-- Size -->
            <div class="form-group">
                <label for="size">Méret:</label>
                <input type="number" name="size" id="size" class="form-control" required min="34" max="47" placeholder="Termék mérete">
            </div>

            <!-- Stock -->
            <div class="form-group">
                <label for="stock">Készlet:</label>
                <input type="number" name="stock" id="stock" class="form-control" required min="0" max="100" placeholder="Raktáron lévő mennyiség">
            </div>

            <!-- Price -->
            <div class="form-group">
                <label for="price">Ár (Ft):</label>
                <input type="number" name="price" id="price" class="form-control" required min="3000" max="1000000" placeholder="Ár">
            </div>

            <!-- Price -->
            <div class="form-group">
                <label for="product_type_id">Termék típusa:</label>
                <select name="product_type_id" id="product_type_id">
                    @foreach($types as $type)
                    <option value="{{$type->id}}">{{$type->type}}</option> 
                    @endforeach
                </select>
            </div>

            <!-- Submit button -->
            <button type="submit" class="btn btn-primary">Mentés</button>
        </form>
    </div>

    <!-- Bootstrap JS (opcionális, ha szükséges) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>