<?php

namespace App\Http\Controllers;

use App\Events\ItemCreatedEvent;
use App\Events\ItemDeletedEvent;
use App\Events\ItemUpdatedEvent;
use App\Models\item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class ItemController extends Controller
{
    public function index()
    {
        $items = Cache::remember('items', now()->addMinutes(10), function () {
            return item::with('category', 'images')->get();
        });

        return response()->json($items);
    }
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $item = Item::create($request->only(['category_id', 'name', 'price', 'description']));

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('items', 'public');
            $item->images()->create(['path' => $path]);
        }

        Cache::forget('items');
        event(new ItemCreatedEvent($item));

        return response()->json($item->load('category', 'images'), 201);
    }
    public function update(Request $request, Item $item)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
        ]);

        $item->update($request->only(['category_id', 'name', 'price', 'description']));

        Cache::forget('items');
        event(new ItemUpdatedEvent($item));

        return response()->json($item->load('category', 'images'));
    }

    public function destroy(Item $item)
    {
        if ($item->images()->exists()) {
            foreach ($item->images as $image) {
                Storage::disk('public')->delete($image->path);
            }
            $item->images()->delete();
        }

        $item->delete();

        Cache::forget('items');
        event(new ItemDeletedEvent($item));

        return response()->json(null, 204);
    }
}
