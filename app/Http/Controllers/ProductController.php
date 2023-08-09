<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::filter(request(['search']))->orderBy('name', 'asc')->paginate(10);

        return view('pages.products', ['type_menu' => 'product', 'products' => $products]);
    }

    public function show(Product $product)
    {
        return view('pages.product', ['type_menu' => 'product', 'product' => $product]);
    }

    public function create()
    {
        return view('pages.create-product', ['type_menu' => 'product']);
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required',
            'sku' => 'required|unique:products',
            'description' => 'required',
            'specification' => 'required'
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate->errors())->withInput();
        }

        $sku = str($request->sku)->slug()->upper();
        $unqieuId = $this->generateUniqueId();

        $product = Product::create([
            'name' => $request->name,
            'sku' => $sku,
            'unique_id' => $unqieuId,
            'description' => $request->description,
            'specification' => $request->specification
        ]);

        if (!$product) {
            return redirect()->back()->with('failed', 'Failed create Product')->withInput();
        }

        return to_route('product.index')->with('success', 'Success create Product');
    }

    public function edit(Product $product)
    {
        return view('pages.edit-product', ['type_menu' => 'product', 'product' => $product]);
    }

    public function update(Request $request, Product $product)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required',
            'sku' => 'required|unique:products,sku,' . $product->id,
            'description' => 'required',
            'specification' => 'required'
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate->errors())->withInput();
        }

        $sku = str($request->sku)->slug()->upper();

        $product->update([
            'name' => $request->name,
            'sku' => $sku,
            'unique_id' => uniqid() . '-' . $sku,
            'description' => $request->description,
            'specification' => $request->specification
        ]);

        if (!$product) {
            return redirect()->back()->with('failed', 'Failed update Product')->withInput();
        }

        return to_route('product.index')->with('success', 'Success update Product');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return to_route('product.index')->with('success', 'Success delete Product');
    }

    public function generateUniqueId()
    {
        $product = Product::orderBy('id', 'desc')->first();

        if ($product) {
            $number = (int) explode('-', $product->unique_id)[1];
            $number++;
            $id = 'P-' . sprintf('%04d', $number);
        } else {
            $id = 'P-0001';
        }

        return $id;
    }
}
