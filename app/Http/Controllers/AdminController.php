<?php

namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use App\Models\User;       // <-- PASTIKAN JALURNYA KE MODELS, BUKAN CONTROLLERS
    use App\Models\Barang;     // <-- Pastikan ini juga ke Models
    use App\Models\Peminjaman; // <-- Pastikan ini juga ke Models

class AdminController extends Controller
{
    public function dashboard()
   {
        // 1. Ambil data statistik untuk card box
        $totalUsers = User::count();
        $totalBarang = Barang::count();
        $totalPeminjaman = Peminjaman::count();
        $pendingCount = Peminjaman::where('status', 'pending')->count();

        // 2. Ambil data transaksi peminjaman (Wajib ada!)
        // Jangan sampai nama variabel ini typo ($peminjaman)
        $peminjaman = Peminjaman::with(['user', 'detailPeminjaman.barang'])
                        ->orderBy('created_at', 'desc')
                        ->get();

        // 3. Kirim ke view. PASTIKAN 'peminjaman' masuk ke dalam daftar compact
        return view('admin.dashboard', compact(
            'totalUsers', 
            'totalBarang', 
            'totalPeminjaman', 
            'pendingCount', 
            'peminjaman' // <-- Jika baris ini hilang/typo, error 'Undefined variable $peminjaman' pasti muncul
        ));
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
        $barang = Barang::all();

    return view('admin.barang', compact('barang'));
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
