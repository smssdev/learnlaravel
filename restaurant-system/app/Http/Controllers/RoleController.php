<?php
// app/Http/Controllers/Api/RoleController.php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

/**
 * @OA\Info(title="Restaurant API", version="1.0")
 */
class RoleController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/roles",
     *     tags={"Roles"},
     *     summary="Get list of roles",
     *     @OA\Response(response=200, description="Successful operation"),
     *     security={{"sanctum": {}}}
     * )
     */
    public function index()
    {
        $roles = Cache::remember('roles', now()->addMinutes(10), function () {
            return Role::all();
        });

        return response()->json($roles);
    }

    /**
     * @OA\Post(
     *     path="/api/roles",
     *     tags={"Roles"},
     *     summary="Create a new role",
     *     @OA\RequestBody(
     *         @OA\JsonContent(
     *             @OA\Property(property="name", type="string", example="manager"),
     *             @OA\Property(property="guard_name", type="string", example="api", nullable=true)
     *         )
     *     ),
     *     @OA\Response(response=201, description="Role created"),
     *     security={{"sanctum": {}}}
     * )
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:roles',
            'guard_name' => 'nullable|string|in:web,api',
        ]);

        $role = Role::create([
            'name' => $request->name,
            'guard_name' => $request->guard_name ?? 'api',
        ]);

        Cache::forget('roles');

        return response()->json($role, 201);
    }

    /**
     * @OA\Patch(
     *     path="/api/roles/{id}",
     *     tags={"Roles"},
     *     summary="Update a role",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         @OA\JsonContent(
     *             @OA\Property(property="name", type="string", example="updated-manager")
     *         )
     *     ),
     *     @OA\Response(response=200, description="Role updated"),
     *     security={{"sanctum": {}}}
     * )
     */
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name,' . $role->id,
        ]);

        $role->update(['name' => $request->name]);

        Cache::forget('roles');

        return response()->json($role);
    }

    /**
     * @OA\Delete(
     *     path="/api/roles/{id}",
     *     tags={"Roles"},
     *     summary="Delete a role",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response=204, description="Role deleted"),
     *     security={{"sanctum": {}}}
     * )
     */
    public function destroy(Role $role)
    {
        if ($role->users()->exists()) {
            return response()->json(['error' => 'لا يمكن حذف الدور لأنه مرتبط بمستخدمين'], 400);
        }

        $role->delete();

        Cache::forget('roles');

        return response()->json(null, 204);
    }
}
?>
