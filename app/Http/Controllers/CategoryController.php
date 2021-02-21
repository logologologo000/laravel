<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function apiIndex()
    {
        $categories = Category::all();
        return response()->json($categories);
    }

    public function apiStore(Request $request)
    {
        $request->validate([
            'name' => 'required:min:3',
        ]);

        $category = new Category();
        $category->name = $request->input('name');
        $category->save();
        return response()->json($category);
    }


    public function apiCategory($id)
    {
        $category = Category::find($id);
        return response()->json($category);
    }

    public function apiUpdate(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|min:3',
        ]);

        $category = Category::find($id);
        $category->name = $request->input('name');
        $category->save();
        return response()->json($category);
    }

    public function apiDestroy($id)
    {
        $category = Category::find($id);
        $category->delete();
        return response()->json(['message' => 'Delete Category successfuly']);
    }
}
