<?php

namespace App\Http\Controllers;

use App\Http\Requests\AssignRoleRequest;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $users = User::all();
        return response()->json($users);
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
