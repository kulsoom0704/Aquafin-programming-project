<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function dashboard()
    {
        $rainfall = [
            ['year' => 2026, 'rainfall' => 950, 'risk' => 'Laag'],
            ['year' => 2027, 'rainfall' => 1010, 'risk' => 'Gemiddeld'],
            ['year' => 2028, 'rainfall' => 1120, 'risk' => 'Hoog'],
            ['year' => 2029, 'rainfall' => 1150, 'risk' => 'Hoog'],
            ['year' => 2030, 'rainfall' => 1050, 'risk' => 'Gemiddeld'],
        ];

        $userCount = User::count();

        return view(
            'admin.dashboard',
            compact('rainfall', 'userCount')
        );
    }

    public function users()
    {
        $users = User::orderBy('name')->get();

        return view('admin.users', compact('users'));
    }

    public function reports()
    {
        return view('admin.reports');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'role' => 'required'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make('Welkom123!'),
            'role' => $request->role,
            'active' => true
        ]);

        return redirect('/admin/users');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect('/admin/users');
    }

    public function toggleStatus(User $user)
    {
        $user->active = !$user->active;
        $user->save();

        return redirect('/admin/users');
    }
}