<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\Product_type;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        /*return view('products.list_products', [
            //'products' => Product::all()
            'products' => Product::all()->where('stock', '>', '0') -> csak a raktáron lévő termékek
        ]);*/
        $query = Product::query();
        $query->where('stock', '>', '0');
        //1.megoldás
        //$query->where('product_type_id', '=', '1'); Ez az egyszerűbb megoldás, ez is jó

        //2.megoldás Ez az bonyolultabb, de dinamikusabb
        $type = Product_type::where('type', 'like', 'shoes')->first();
        $query->where('product_type_id', '=', $type->id); 
        
        
    
        // Szűrés név/márka alapján
        if ($request->has('brand') && !empty($request->brand)) {
            $query->where('brand', 'like', '%' . $request->brand . '%');
        }

        // Szűrés modell alapján
        if ($request->has('modell') && !empty($request->modell)) {
            $query->where('modell', 'like', '%' . $request->modell . '%');
        }

        // Szűrés szín alapján
        if ($request->has('color') && !empty($request->color)) {
            $query->where('color', $request->color);
        }

        // Szűrés méret alapján
        if ($request->has('size') && !empty($request->size)) {
            $query->where('size', $request->size);
        }

        // Szűrés ár alapján (minimum és maximum ár)
        if ($request->has('min_price') && !empty($request->min_price)) {
            $query->where('price', '>=', $request->min_price);
        }

        if ($request->has('max_price') && !empty($request->max_price)) {
            $query->where('price', '<=', $request->max_price);
        }

        // Termékek lekérése a szűrési feltételek alapján
        $products = $query->get();

        // A szűrési feltételek visszaadása a nézethez, hogy megmaradjanak az űrlapban
        return view('products.shoes.list_products', compact('products'));
    }

    public function store(Request $request)
    {
        /*$product = new Product();
        $product->brand = $request->brand;
        $product->modell = $request->modell;
        $product->color = $request->color;
        $product->size = $request->size;
        $product->stock = $request->stock;
        $product->price = $request->price;
        

        /*if($product->save()) {
            return view('products.list_products', [
                'products' => Product::all()
            ]);
        }
        else  Session::flash('error', 'An error occurred during upload');
        if($product->save()) {
        // Sikeres mentés után átirányítjuk a felhasználót a termékek listájára
        return redirect()->route('products.index')->with('success' , 'Product successfully added!');
    } else {
        // Hibakezelés, ha a mentés nem sikerült
        return redirect()->back()->with('error', 'An error occurred during upload');
    }*/
    $request->validate([
        'brand' => 'required|string|max:255',
        'modell' => 'required|string|max:255',
        'color' => 'required|string|max:255',
        'size' => 'required|integer|min:34|max:47',
        'stock' => 'required|integer|min:0|max:100',
        'price' => 'required|integer|min:3000|max:1000000',
        'product_type_id' => 'required|integer|min:0|max:5',
    ]);

    // Új termék létrehozása
    Product::create([
        'brand' => $request->brand,
        'modell' => $request->modell,
        'color' => $request->color,
        'size' => $request->size,
        'stock' => $request->stock,
        'price' => $request->price,
        'product_type_id' => $request->product_type_id,
    ]);

    if($request->product_type_id == 1){
        return redirect()->route('products.index')->with('success', 'Termék sikeresen hozzáadva!');
    }
    else return redirect()->route('products.clothes_index')->with('success', 'Termék sikeresen hozzáadva!');

    }
    public function update(Request $request, $id)
{
    $product = Product::find($id);

    $request->validate([
        'quantity' => 'required|integer|min:1',
    ]);

    // Ellenőrizzük, hogy van-e elég készlet
    if ($request->quantity > $product->stock) {
        return redirect()->route('products.index')->with('error', 'Nincs elegendő készlet.');
    }

    // Készlet csökkentése
    $product->stock -= $request->quantity;
    $product->save();

    return redirect()->back()->with('success', 'A vásárlás sikeres volt! A készlet frissítve lett.');
}

    public function adminIndex()
    {
        // Az összes termék listázása az admin oldalon
        $products = Product::all();
        return view('products.shoes.admin_products', compact('products'));
    }

    public function destroy($id)
    {
        $product = Product::find($id);

        if ($product) {
            $product->delete();
            return redirect()->route('admin_termekek')->with('success', 'A termék sikeresen törölve lett.');
        }

        return redirect()->route('admin_termekek')->with('error', 'A termék nem található.');
    }

    public function clothes_index(Request $request)
    {
        /*return view('products.list_products', [
            //'products' => Product::all()
            'products' => Product::all()->where('stock', '>', '0') -> csak a raktáron lévő termékek
        ]);*/
        $query = Product::query();
        $query->where('stock', '>', '0');
        //1.megoldás
        //$query->where('product_type_id', '=', '1'); Ez az egyszerűbb megoldás, ez is jó

        //2.megoldás Ez az bonyolultabb, de dinamikusabb
        $type = Product_type::where('type', 'like', 'clothes')->first();
        $query->where('product_type_id', '=', $type->id); 
        
        
    
        // Szűrés név/márka alapján
        if ($request->has('brand') && !empty($request->brand)) {
            $query->where('brand', 'like', '%' . $request->brand . '%');
        }

        // Szűrés modell alapján
        if ($request->has('modell') && !empty($request->modell)) {
            $query->where('modell', 'like', '%' . $request->modell . '%');
        }

        // Szűrés szín alapján
        if ($request->has('color') && !empty($request->color)) {
            $query->where('color', $request->color);
        }

        // Szűrés méret alapján
        if ($request->has('size') && !empty($request->size)) {
            $query->where('size', $request->size);
        }

        // Szűrés ár alapján (minimum és maximum ár)
        if ($request->has('min_price') && !empty($request->min_price)) {
            $query->where('price', '>=', $request->min_price);
        }

        if ($request->has('max_price') && !empty($request->max_price)) {
            $query->where('price', '<=', $request->max_price);
        }

        // Termékek lekérése a szűrési feltételek alapján
        $products = $query->get();

        // A szűrési feltételek visszaadása a nézethez, hogy megmaradjanak az űrlapban
        return view('products.clothes.list_products', compact('products'));
    }

}
