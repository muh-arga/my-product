<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        if (auth()->user()->role == 'superadmin') {
            $users = User::filter(request(['search']))->where('role', '!=', 'superadmin')->orderBy('name', 'asc')->paginate(10);
        } else {
            $users = User::filter(request(['search']))->where('role', 'user')->orderBy('name', 'asc')->paginate(10);
        }
        return view('pages.users', ['type_menu' => 'user', 'users' => $users]);
    }

    public function create()
    {
        return view('pages.create-user', ['type_menu' => 'user']);
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'string|min:8|confirmed',
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate->errors())->withInput();
        }

        $role = 'user';

        if (auth()->user()->role == 'superadmin') {
            $role = $request->role;
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $role,
            'password' => Hash::make($request->password),
        ]);

        if (!$user) {
            return redirect()->back()->with('failed', 'Failed create user');
        }

        return to_route('user.index')->with('success', 'Success create user');
    }

    public function edit(User $user)
    {
        return view('pages.edit-user', ['type_menu' => 'user', 'user' => $user]);
    }

    public function update(Request $request, User $user)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required',
            'password' => 'string|min:8|confirmed|nullable',
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate->errors())->withInput();
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        if (!$user) {
            return redirect()->back()->with('failed', 'Failed update user');
        }

        return to_route('user.index')->with('success', 'Success update user');
    }

    public function changeRole(User $user)
    {
        $user->update([
            'role' => 'admin'
        ]);

        return redirect()->back()->with('success', 'Success change role User');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->back()->with('success', 'Success delete user');
    }
}
