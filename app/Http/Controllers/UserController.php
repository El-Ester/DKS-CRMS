<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with('role')->get();
        return view('systemAdmin.userManagement', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('systemAdmin.createNewUser', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_name' => 'required|unique:users',
            'user_email' => 'required|email|unique:users',
            'user_password' => 'required|min:6',
        ]);

        User::create([
            'user_name' => $request->user_name,
            'user_full_name' => $request->user_full_name,
            'user_email' => $request->user_email,
            'user_password' => bcrypt($request->user_password),
            'user_role' => $request->user_role,
        ]);

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        return view('systemAdmin.editUsers', compact('user', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'user_name' => 'required|unique:users,user_name,' . $id . ',user_id',
            'user_email' => 'required|email|unique:users,user_email,' . $id . ',user_id',
        ]);

        $user = User::findOrFail($id);
        $user->update([
            'user_name' => $request->user_name,
            'user_full_name' => $request->user_full_name,
            'user_email' => $request->user_email,
            'user_role' => $request->user_role
        ]);

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }

}
