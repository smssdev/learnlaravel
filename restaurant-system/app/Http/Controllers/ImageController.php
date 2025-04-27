<?php
// app/Http/Controllers/Api/ImageController.php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Events\ImageUploadedEvent;
use App\Events\ImageDeletedEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

/**
 * @OA\Info(title="Restaurant API", version="1.0")
 */
class ImageController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/images",
     *     tags={"Images"},
     *     summary="Upload an image",
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 @OA\Property(property="image", type="string", format="binary"),
     *                 @OA\Property(property="imageable_id", type="integer", example=1),
     *                 @OA\Property(property="imageable_type", type="string", example="App\\Models\\Item")
     *             )
     *         )
     *     ),
     *     @OA\Response(response=201, description="Image uploaded"),
     *     security={{"sanctum": {}}}
     * )
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'imageable_id' => 'required|integer',
            'imageable_type' => 'required|string|in:App\\Models\\Item,App\\Models\\User',
        ]);

        $path = $request->file('image')->store('images', 'public');

        $image = Image::create([
            'path' => $path,
            'imageable_id' => $request->imageable_id,
            'imageable_type' => $request->imageable_type,
        ]);

        // event(new ImageUploadedEvent($image));

        return response()->json($image, 201);
    }

    /**
     * @OA\Get(
     *     path="/api/images/{id}",
     *     tags={"Images"},
     *     summary="Get an image",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response=200, description="Successful operation"),
     *     security={{"sanctum": {}}}
     * )
     */
    public function show(Image $image)
    {
        return response()->json($image);
    }

    /**
     * @OA\Delete(
     *     path="/api/images/{id}",
     *     tags={"Images"},
     *     summary="Delete an image",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response=204, description="Image deleted"),
     *     security={{"sanctum": {}}}
     * )
     */
    public function destroy(Image $image)
    {
        Storage::disk('public')->delete($image->path);
        $image->delete();

        // event(new ImageDeletedEvent($image));

        return response()->json(null, 204);
    }
}
