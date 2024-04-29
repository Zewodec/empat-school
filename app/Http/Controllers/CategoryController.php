<?php

namespace App\Http\Controllers;

use App\Models\CategoryProduct;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function allCategories()
    {
        // get all categories
        $categories = CategoryProduct::all();

        return response()->json([
            'success' => true,
            'data' => $categories
        ]);
    }

    public function showCategory($category)
    {
        if (!is_numeric($category)) {
            return response()->json([
                'success' => false,
                'data' => 'Category ID must be a number.'
            ], 400);
        }

        // get category by id
        $category = CategoryProduct::find($category);

        if(!$category) {
            return response()->json([
                'success' => false,
                'data' => 'Category not found.'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $category
        ]);
    }

    public function addCategory(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required'
        ]);

        $category = CategoryProduct::create([
            'name' => request('name'),
            'description' => request('description')
        ]);

        $category->save();

        return response()->json([
            'success' => true,
            'data' => $category
        ]);
    }

    public function patchCategory($categoryId, Request $request)
    {
        $category = CategoryProduct::find($categoryId);

        if(!$category) {
            return response()->json([
                'success' => false,
                'data' => 'Category not found.'
            ], 404);
        }

        $request->validate([
            'name' => 'required',
            'description' => 'required'
        ]);

        $category->update([
            'name' => request('name'),
            'description' => request('description')
        ]);

        return response()->json([
            'success' => true,
            'data' => $category
        ]);
    }
}
