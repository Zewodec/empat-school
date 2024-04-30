<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index($categoryId): \Illuminate\Http\JsonResponse
    {
        $products = Product::where('category_id', $categoryId)->get();

        return response()->json([
            'success' => true,
            'data' => $products
        ]);
    }

    public function show($categoryId, $productId)
    {
        $product = Product::where('category_id', $categoryId)->where('id', $productId)->get();

        $product = $product->load('category');

        if(!$product) {
            return response()->json([
                'success' => false,
                'data' => 'Product not found.'
            ], 404);
        }


        if (json_decode($product) == null) {
            return response()->json([
                'success' => false,
                'data' => 'No product in such category.'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $product
        ]);
    }

    public function addProduct($categoryId, Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
        ]);

        $product = Product::create([
            'name' => request('name'),
            'description' => request('description'),
            'price' => request('price'),
            'category_id' => $categoryId,
        ]);

        $product->save();

        return response()->json([
            'success' => true,
            'data' => $product
        ]);
    }

    public function patchProduct($categoryId, $productId, Request $request)
    {
        $product = Product::find($productId);

        if(!$product) {
            return response()->json([
                'success' => false,
                'data' => 'Product not found.'
            ], 404);
        }

        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
        ]);

        $product->update([
            'name' => request('name'),
            'description' => request('description'),
            'price' => request('price'),
        ]);

        return response()->json([
            'success' => true,
            'data' => $product
        ]);
    }
}
