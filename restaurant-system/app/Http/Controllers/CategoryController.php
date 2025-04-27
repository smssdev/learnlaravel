<?php

namespace App\Http\Controllers;

use App\Events\CategoryCreatedEvent;
use App\Events\CategoryDeletedEvent;
use App\Events\CategoryUpdatedEvent;
use App\Models\category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Cache::remember('categories', now()->addMinutes(10), function () {
            return category::all();
        });

        return response()->json($categories);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories',
        ]);

        $category = Category::create(['name' => $request->name]);

        Cache::forget('categories');
        event(new CategoryCreatedEvent($category));

        return response()->json($category, 201);
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
        ]);

        $category->update(['name' => $request->name]);

        Cache::forget('categories');
        event(new CategoryUpdatedEvent($category));

        return response()->json($category);
    }


    public function destroy(Category $category)
    {
        if ($category->items()->exists()) {
            return response()->json(['error' => 'لا يمكن حذف الفئة لأنها تحتوي على أصناف مرتبطة'], 400);
        }

        $category->delete();

        Cache::forget('categories');
        event(new CategoryDeletedEvent($category));

        return response()->json(null, 204);
    }

}
