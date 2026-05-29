<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\LoginHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    // Menampilkan daftar user
    public function index()
    {
        $users = User::with('loginHistories')->orderBy('created_at', 'desc')->get();
        return view('admin.users', compact('users'));
    }

    // Menambah user baru
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users,username',
            'password' => 'required|min:6',
            'kelas' => 'nullable|string',
            'role' => 'required|in:admin,user',
        ]);

        User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'kelas' => $request->kelas,
            'role' => $request->role,
        ]);

        return redirect()->route('admin.users')->with('success', 'User berhasil ditambahkan!');
    }

    // Menghapus user
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        
        // Cegah menghapus admin terakhir atau diri sendiri
        if ($user->role == 'admin' && User::where('role', 'admin')->count() <= 1) {
            return redirect()->route('admin.users')->with('error', 'Tidak bisa menghapus admin terakhir!');
        }
        
        if ($user->id == auth()->id()) {
            return redirect()->route('admin.users')->with('error', 'Tidak bisa menghapus akun sendiri!');
        }
        
        $user->delete();
        
        return redirect()->route('admin.users')->with('success', 'User berhasil dihapus!');
    }
}