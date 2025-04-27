<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = Cache::remember('users', now()->addMinutes(10), function () {
            return User::with('roles')->get();
        });

        return response()->json($users);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|in:admin,customer',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->assignRole($request->role);

        Cache::forget('users');

        return response()->json($user->load('roles'), 201);
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|in:admin,customer',
        ]);

        $user->update(['name' => $request->name]);
        $user->syncRoles([$request->role]);

        Cache::forget('users');

        return response()->json($user->load('roles'));
    }

    public function destroy(User $user)
    {
        $user->delete();

        Cache::forget('users');

        return response()->json(null, 204);
    }



}
