<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

Route::post('/register', function (Request $request) {
    $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:6',
    ]);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    $user->assignRole('user');

    return response()->json([
        'token' => $user->createToken('auth_token')->plainTextToken,
        'user' => $user
    ]);
});

Route::post('/login', function (Request $request) {
    $user = User::where('email', $request->email)->first();

    if (! $user || ! Hash::check($request->password, $user->password)) {
        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    return response()->json([
        'token' => $user->createToken('auth_token')->plainTextToken,
        'user' => $user
    ]);
});

Route::middleware('auth:sanctum')->get('/me', function (Request $request) {
    return [
        'user' => $request->user(),
        'roles' => $request->user()->getRoleNames(),
        'permissions' => $request->user()->getPermissionNames()
    ];
});
