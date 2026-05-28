<?php

namespace App\Http\Controllers;

use App\Http\Requests\PinjamRequest;
use App\Models\Barang;
use App\Models\Peminjaman;
use Illuminate\Support\Facades\Auth;

class SiswaController extends Controller
{
    public function index()
    {
        $barang = Barang::orderBy('nama')->get();
        $pinjamanAktif = Peminjaman::with('barang')
            ->where('user_id', Auth::id())
            ->aktif()
            ->latest()
            ->get();

        return view('siswa.index', compact('barang', 'pinjamanAktif'));
    }

    public function createPinjam(int $id)
    {
        $barang = Barang::findOrFail($id);

        if ($barang->stock <= 0) {
            return redirect()->route('siswa.index')->with('error', 'Barang sedang tidak tersedia.');
        }

        return view('siswa.pinjam', compact('barang'));
    }

    public function pinjam(PinjamRequest $request, int $id)
    {
        $barang = Barang::findOrFail($id);

        if ($barang->stock < $request->qty) {
            return back()->with('error', 'Stok tidak mencukupi');
        }

        Peminjaman::create([
            'user_id' => Auth::id(),
            'barang_id' => $barang->id,
            'nama_peminjam' => $request->nama_peminjam,
            'jam_pinjam' => $request->jam_pinjam,
            'guru_pembimbing' => $request->guru_pembimbing,
            'qty' => (int) $request->qty,
            'status' => Peminjaman::STATUS_DIPINJAM,
        ]);

        $barang->decrement('stock', $request->qty);

        return redirect()->route('siswa.index')->with('success', 'Peminjaman berhasil dibuat.');
    }
}
