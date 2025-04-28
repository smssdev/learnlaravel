<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:sanctum', 'permission:view users'])->only(['index', 'show']);
        $this->middleware(['auth:sanctum', 'permission:create users'])->only(['store']);
        $this->middleware(['auth:sanctum', 'permission:edit users'])->only(['update']);
        $this->middleware(['auth:sanctum', 'permission:delete users'])->only(['destroy']);
    }

    public function index()
    {
        $users = User::with('roles')->get();
        return UserResource::collection($users);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'phone' => 'nullable|string|max:15',
            'status' => 'required|in:active,inactive',
            'job_title' => 'nullable|string|max:100',
            'restaurant_id' => 'nullable|exists:restaurants,id',
            'roles' => 'nullable|array',
            'roles.*' => 'exists:roles,name',
            'permissions' => 'nullable|array',
            'permissions.*' => 'exists:permissions,name',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'status' => $request->status,
            'job_title' => $request->job_title,
            'restaurant_id' => $request->restaurant_id,
        ]);

        if ($request->roles) {
            $user->assignRole($request->roles);
        }

        if ($request->permissions) {
            $user->givePermissionTo($request->permissions);
        }

        return new UserResource($user->load('roles', 'permissions'));
    }

    public function show(User $user)
    {
        return new UserResource($user->load('roles', 'permissions'));
    }

    public function update(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:15',
            'status' => 'required|in:active,inactive',
            'job_title' => 'nullable|string|max:100',
            'restaurant_id' => 'nullable|exists:restaurants,id',
            'roles' => 'nullable|array',
            'roles.*' => 'exists:roles,name',
            'permissions' => 'nullable|array',
            'permissions.*' => 'exists:permissions,name',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'status' => $request->status,
            'job_title' => $request->job_title,
            'restaurant_id' => $request->restaurant_id,
        ]);

        if ($request->roles) {
            $user->syncRoles($request->roles);
        } else {
            $user->roles()->detach();
        }

        if ($request->permissions) {
            $user->syncPermissions($request->permissions);
        } else {
            $user->permissions()->detach();
        }

        return new UserResource($user->load('roles', 'permissions'));
    }

    public function destroy(User $user)
    {
        $user->delete();
        return response()->json(['message' => 'User deleted successfully'], 200);
    }
}
