<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\RestaurantResource;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RestaurantController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:sanctum', 'permission:view restaurants'])->only(['index', 'show']);
        $this->middleware(['auth:sanctum', 'permission:create restaurants'])->only(['store']);
        $this->middleware(['auth:sanctum', 'permission:edit restaurants'])->only(['update']);
        $this->middleware(['auth:sanctum', 'permission:delete restaurants'])->only(['destroy']);
    }

    public function index()
    {
        $restaurants = Restaurant::all();
        return RestaurantResource::collection($restaurants);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $restaurant = Restaurant::create($request->only(['name', 'address']));
        return new RestaurantResource($restaurant);
    }

    public function show(Restaurant $restaurant)
    {
        return new RestaurantResource($restaurant);
    }

    public function update(Request $request, Restaurant $restaurant)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $restaurant->update($request->only(['name', 'address']));
        return new RestaurantResource($restaurant);
    }

    public function destroy(Restaurant $restaurant)
    {
        $restaurant->delete();
        return response()->json(['message' => 'Restaurant deleted successfully'], 200);
    }
}
