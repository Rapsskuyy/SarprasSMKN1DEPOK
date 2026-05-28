<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBarangRequest;
use App\Http\Requests\UpdateBarangRequest;
use App\Models\Barang;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function index()
    {
        $barang = Barang::orderBy('nama')->get();
        $activePeminjaman = Peminjaman::with(['user', 'barang'])
            ->aktif()
            ->latest()
            ->get();

        return view('admin.dashboard', compact('barang', 'activePeminjaman'));
    }

    public function history()
    {
        $historyPeminjaman = Peminjaman::with(['user', 'barang'])
            ->selesai()
            ->latest()
            ->paginate(15);

        return view('admin.history', compact('historyPeminjaman'));
    }

    public function store(StoreBarangRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('gambar')) {
            $data['gambar'] = 'storage/' . $request->file('gambar')->store('barang', 'public');
        }

        Barang::create($data);

        return redirect()->back()->with('success', 'Barang berhasil ditambahkan');
    }

    public function update(UpdateBarangRequest $request, int $id)
    {
        $barang = Barang::findOrFail($id);
        $data = $request->validated();

        if ($request->hasFile('gambar')) {
            if ($barang->gambar) {
                $oldPath = str_replace('storage/', '', $barang->gambar);
                Storage::disk('public')->delete($oldPath);
            }
            $data['gambar'] = 'storage/' . $request->file('gambar')->store('barang', 'public');
        }

        $barang->update($data);

        return redirect()->back()->with('success', 'Barang berhasil diperbarui');
    }

    public function updateStock(Request $request, int $id)
    {
        $request->validate(['change' => 'required|integer']);

        $barang = Barang::findOrFail($id);
        $change = (int) $request->input('change', 0);
        $newStock = max(0, $barang->stock + $change);

        $barang->update(['stock' => $newStock]);

        return response()->json([
            'success' => true,
            'new_stock' => $newStock,
        ]);
    }

    public function destroy(int $id)
    {
        $barang = Barang::findOrFail($id);

        if ($barang->gambar) {
            $oldPath = str_replace('storage/', '', $barang->gambar);
            Storage::disk('public')->delete($oldPath);
        }

        $barang->delete();

        return redirect()->back()->with('success', 'Barang berhasil dihapus');
    }

    public function returnItem(int $id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        $peminjaman->update([
            'status' => Peminjaman::STATUS_KEMBALI,
            'jam_kembali' => now()->format('H:i'),
        ]);

        $peminjaman->barang->increment('stock', $peminjaman->qty);

        return redirect()->back()->with('success', 'Barang telah dikembalikan');
    }
}
