<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProfileRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Models\Profile;

class ProfileController extends Controller
{
    public function index()
    {
        $profile = Profile::all();
        return response()->json($profile, 200);
    }
    public function store(StoreProfileRequest $request)
    {
        $data = $request->validated();
        if (!empty($data['date_of_birth'])) {
            $data['date_of_birth'] = \Carbon\Carbon::createFromFormat('d-m-Y', $data['date_of_birth'])->format('Y-m-d');
        }
        $profile = Profile::create($data);
        return response()->json([
            'message' => 'Profile created successfully',
            'profile' => $profile
        ], 201);
    }
    public function update(UpdateProfileRequest $request, $id)
    {
        $profile = Profile::findOrFail($id);
        $validatedData = $request->validated();
        if (!empty($validatedData['date_of_birth'])) {
            $validatedData['date_of_birth'] = \Carbon\Carbon::createFromFormat('d-m-Y', $validatedData['date_of_birth'])->format('Y-m-d');
        }
        $profile->update($validatedData);
        return response()->json($profile, 200);
    }
    public function show($id)
    {
        $profile = Profile::where('user_id',$id)->firstOrFail();
        return response()->json($profile, 200);
    }
    public function destroy($id)
    {
        $profile = Profile::findOrFail($id);
        $profile->delete($id);
        return response()->json(null, 204);
    }
}
