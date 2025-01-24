<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\AssignRoleRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function listUsers()
    {
        $users = User::all();
        return response()->json($users);
    }

    public function createUser(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        return response()->json(['message' => 'User created successfully', 'user' => $user], 201);
    }

    public function assignRole(AssignRoleRequest $request, $userId)
    {
        $validated = $request->validated();
        $user = User::findOrFail($userId);
        $user->roles()->sync($validated['role_ids']);
        return response()->json(['message' => 'Role(s) assigned successfully']);
    }

    public function deleteUser($userId)
    {
        $user = User::findOrFail($userId);
        $user->delete();
        return response()->json(['message' => 'User deleted successfully']);
    }
}
