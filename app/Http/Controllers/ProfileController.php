<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ProfileController extends Controller
{
    public function index()
    {
        $pendingUsers = collect(); // Initialize as empty collection by default

        if (auth()->user()->role === 'admin') {
            $pendingUsers = User::where('is_active', false)->get();
        }

        return view('profile.index', compact('pendingUsers'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'faculty' => 'nullable|string|max:255',
            'room' => 'nullable|string|max:255',
            'dormitory' => 'nullable|string|max:255',
        ]);

        auth()->user()->update($request->only('name', 'faculty', 'room', 'dormitory'));

        return back()->with('success', 'Profile updated successfully!');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = auth()->user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'The provided password does not match your current password.']);
        }

        $user->update([
            'password' => Hash::make($request->password)
        ]);

        return back()->with('success', 'Password updated successfully!');
    }

    public function activateUser(User $user)
    {
        if (auth()->user()->role !== 'admin') {
            return back()->with('error', 'Unauthorized action.');
        }

        $user->update(['is_active' => true]);
        return back()->with('success', 'Contul a fost activat cu succes!');
    }
}
