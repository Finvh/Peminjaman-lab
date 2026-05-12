<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Peminjaman;
use App\Models\DetailPeminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function dashboard()
    {
        $userId = Auth::id();

        $peminjaman = Peminjaman::with('detailPeminjaman.barang')
            ->where('id_user', $userId)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('user.dashboard', compact('peminjaman'));
    }

    public function barang()
    {
        $barang = Barang::all();
        return view('user.barang', compact('barang'));
    }

    public function createBooking()
    {
        $barang = Barang::all();
        return view('user.booking', compact('barang'));
    }

    public function storeBooking(Request $request)
    {
        $request->validate([
            'barang_id' => 'required|array',
            'barang_id.*' => 'exists:barang,id',
            'qty' => 'required|array',
            'qty.*' => 'integer|min:1',
            'tggl_pinjm' => 'required|date|after_or_equal:today',
        ]);

        DB::beginTransaction();

        try {
            // Create peminjaman
            $peminjaman = Peminjaman::create([
                'id_user' => Auth::id(),
                'tggl_pinjm' => $request->tggl_pinjm,
                'attribute' => 'pending',
            ]);

            // Create detail peminjaman
            foreach ($request->barang_id as $index => $barangId) {
                $barang = Barang::find($barangId);

                if ($barang->jumlah_barang < $request->qty[$index]) {
                    throw new \Exception("Stok {$barang->nama_barang} tidak mencukupi");
                }

                // Reduce stock
                $barang->decrement('jumlah_barang', $request->qty[$index]);

                DetailPeminjaman::create([
                    'id_peminjaman' => $peminjaman->id,
                    'id_barang' => $barangId,
                    'qty' => $request->qty[$index],
                    'status_peminjaman' => 'dipinjam',
                ]);
            }

            DB::commit();
            return redirect()->route('user.dashboard')->with('success', 'Peminjaman berhasil diajukan!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }
}
