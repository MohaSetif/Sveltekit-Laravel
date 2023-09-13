<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Product::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $product = new Product;

        $product->name = $request->input('name');
        $product->details = $request->input('details');
        $product->price = $request->input('price');

        $product->save();

        return response()->json([
            'message' => 'Product created successfully',
            'product' => $product,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $product = Product::find($id);
        if ($product) {
            return response()->json($product);
        } else {
            return response()->json(['error' => 'Product not found'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $product = Product::whereId($id)->first();

        $product->update([
            'name'=>$request->name,
            'details'=>$request->details,
            'price'=>$request->price
        ]);
        
        return response()->json('success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Product::whereId($id)->first()->delete();
        return response()->json('success');
    }
}
