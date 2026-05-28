@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">
    <a href="{{ route('siswa.index') }}" class="inline-flex items-center text-sm text-blue-400 hover:text-blue-300">
        &larr; Kembali ke katalog
    </a>

    <section class="rounded-3xl border border-slate-800 bg-slate-900 overflow-hidden">
        <div class="grid grid-cols-1 md:grid-cols-2">
            <div class="h-64 bg-slate-800">
                @if($barang->gambar)
                    <img src="{{ $barang->gambar_url }}" alt="{{ $barang->nama }}" class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full flex items-center justify-center text-slate-600">Tidak ada gambar</div>
                @endif
            </div>
            <div class="p-6">
                <p class="text-xs uppercase tracking-[0.2em] text-slate-400">Detail Barang</p>
                <h2 class="text-2xl font-black text-white mt-2">{{ $barang->nama }}</h2>
                <p class="text-slate-400 text-sm mt-2">{{ $barang->keterangan ?: 'Tidak ada keterangan' }}</p>
                <p class="mt-4 text-sm text-slate-300">Stok tersedia: <span class="font-bold text-white">{{ $barang->stock }}</span></p>
            </div>
        </div>
    </section>

    <section class="rounded-3xl border border-slate-800 bg-slate-900 p-6">
        <h3 class="text-xl font-bold text-white mb-4">Form Peminjaman</h3>

        <form method="POST" action="{{ route('siswa.pinjam', $barang->id) }}" class="space-y-4">
            @csrf

            <div>
                <label class="block text-sm text-slate-300 mb-1">Nama Peminjam</label>
                <input type="text" name="nama_peminjam" value="{{ old('nama_peminjam', Auth::user()->name) }}" class="w-full rounded-xl bg-slate-950 border border-slate-700 px-4 py-3 text-white" required>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm text-slate-300 mb-1">Jam Pinjam</label>
                    <input type="time" name="jam_pinjam" value="{{ old('jam_pinjam', date('H:i')) }}" class="w-full rounded-xl bg-slate-950 border border-slate-700 px-4 py-3 text-white" required>
                </div>
                <div>
                    <label class="block text-sm text-slate-300 mb-1">Jumlah (Qty)</label>
                    <input type="number" name="qty" value="{{ old('qty', 1) }}" min="1" max="{{ $barang->stock }}" class="w-full rounded-xl bg-slate-950 border border-slate-700 px-4 py-3 text-white" required>
                </div>
            </div>

            <div>
                <label class="block text-sm text-slate-300 mb-1">Guru Pembimbing</label>
                <input type="text" name="guru_pembimbing" value="{{ old('guru_pembimbing') }}" placeholder="Nama guru penanggung jawab" class="w-full rounded-xl bg-slate-950 border border-slate-700 px-4 py-3 text-white" required>
            </div>

            <button type="submit" class="w-full rounded-xl bg-blue-600 hover:bg-blue-700 py-3 text-white font-bold uppercase tracking-wider text-sm">
                Konfirmasi Peminjaman
            </button>
        </form>
    </section>
</div>
@endsection
