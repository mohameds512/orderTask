<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Resources\ProductResource;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth')->except(['index', 'show']);
    // }
    public function index()
    {
        $products = Product::all();
        $productsRes = ProductResource::collection($products);

        return \response()->json($productsRes);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
        ]);

        Product::create($request->all());

        return response()->json(['message'=>"Created Successfully"]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        if($product){
            return new ProductResource($product);
        }
        return response()->json(['message' => "Not Found"]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
        ]);

        $product->update($request->all());
        return response()->json('Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        if($product){
            $product->delete();
            return response()->json("Deleted Successfully");
        }
        return response()->json("Deleted Failed", 400);
    }
}
