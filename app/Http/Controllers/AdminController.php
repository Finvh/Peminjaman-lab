<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    // User Management
    public function users()
    {
        return view('admin.users');
    }

    public function storeUser(Request $request)
    {
        //
    }

    public function deleteUser($id)
    {
        //
    }

    // Barang Management
    public function barang()
    {
        return view('admin.barang');
    }

    public function storeBarang(Request $request)
    {
        //
    }

    public function updateBarang(Request $request, $id)
    {
        //
    }

    public function deleteBarang($id)
    {
        //
    }

    // Peminjaman
    public function updateStatus(Request $request, $id)
    {
        //
    }
}
