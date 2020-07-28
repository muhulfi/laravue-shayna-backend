<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Models\ProductGallery;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $items = Product::all();
        return view('pages.products.index')->with([
            'items' => $items
        ]);
    }

    public function create()
    {
        return view('pages.products.create');
    }

    public function store(ProductRequest $request)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($request->name);

        Product::create($data);
        return redirect()->route('products.index');
    }

    public function show($id)
    {
        //
    }

    public function gallery($id)
    {
        //
    }

    public function edit($id)
    {
        $item = Product::findOrFail($id);

        return view('pages.products.edit')->with([
            'item' => $item
        ]);
    }

    public function update(ProductRequest $request, $id)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($request->name);

        $item = Product::findOrFail($id);
        $item->update($data);

        return redirect()->route('products.index');
    }

    public function destroy($id)
    {
        $item = Product::findOrFail($id);
        $item->delete();
        ProductGallery::where('product_id', $id)->delete();

        return redirect()->route('products.index');
    }

    public function gallery(Request $request, $id) {
        $product = Product::findOrFail($id);
        $items = ProductGallery::with('product')->where('product_id', $id)->get();

        return view('pages.products.gallery')->with([
            'product' => $product,
            'items' => $items
        ]);
    }
}
