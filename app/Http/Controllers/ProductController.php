<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Product;

class ProductController extends Controller
{

    private $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function index()
    {
        $products = $this->product->getAll();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.form');
    }

    public function store(ProductRequest $request)
    {
        $this->product->save($request->only('name', 'quantity', 'price'));
        session()->flash('success', 'Product created successfully!');
        return redirect()->route('products.index');
    }

    public function edit($id)
    {
        $product = $this->product->find($id);
        return view('products.form', compact('product'));
    }

    public function update(ProductRequest $request, $id)
    {
        $this->product->update($id, $request->only('name', 'quantity', 'price'));
        session()->flash('success', 'Product updated successfully!');
        return redirect()->route('products.index');
    }


    public function destroy($id)
    {
        $this->product->delete($id);
        session()->flash('success', 'Product deleted successfully!');
        return redirect()->route('products.index');
    }
}
