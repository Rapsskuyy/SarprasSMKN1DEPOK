@extends('layouts.app')

@section('content')
<div class="space-y-8">
    <section class="rounded-3xl border border-slate-800 bg-gradient-to-r from-slate-900 to-blue-950 p-6 md:p-8">
        <p class="text-xs uppercase tracking-[0.2em] text-blue-300 font-bold">Dashboard Siswa</p>
        <h2 class="text-3xl font-black text-white mt-2">Peminjaman Sarpras</h2>
        <p class="text-slate-300 mt-2">Pilih barang dari katalog lalu isi form peminjaman.</p>
    </section>

    <section class="rounded-3xl border border-slate-800 bg-slate-900 p-6">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-xl font-bold text-white">Pinjaman Aktif Saya</h3>
            <span class="text-xs uppercase tracking-[0.2em] text-slate-400">{{ $pinjamanAktif->count() }} transaksi</span>
        </div>

        @if($pinjamanAktif->isEmpty())
            <p class="text-slate-400 text-sm">Belum ada pinjaman aktif.</p>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead>
                        <tr class="text-left text-slate-400 border-b border-slate-800">
                            <th class="py-2 pr-4">Barang</th>
                            <th class="py-2 pr-4">Qty</th>
                            <th class="py-2 pr-4">Jam Pinjam</th>
                            <th class="py-2 pr-4">Guru</th>
                            <th class="py-2">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pinjamanAktif as $pinjam)
                            <tr class="border-b border-slate-800/50">
                                <td class="py-3 pr-4 text-white">{{ $pinjam->barang->nama ?? '-' }}</td>
                                <td class="py-3 pr-4 text-slate-300">{{ $pinjam->qty }}</td>
                                <td class="py-3 pr-4 text-slate-300">{{ $pinjam->jam_pinjam }}</td>
                                <td class="py-3 pr-4 text-slate-300">{{ $pinjam->guru_pembimbing }}</td>
                                <td class="py-3">
                                    <span class="inline-flex rounded-full bg-emerald-600/20 border border-emerald-500/40 px-3 py-1 text-xs font-semibold text-emerald-300">
                                        Dipinjam
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </section>

    <section>
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-2xl font-black text-white">Katalog Barang</h3>
            <p class="text-xs uppercase tracking-[0.2em] text-slate-400">{{ $barang->count() }} item</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($barang as $b)
                <article class="rounded-3xl border border-slate-800 bg-slate-900 overflow-hidden flex flex-col">
                    <div class="h-48 bg-slate-800 flex items-center justify-center">
                        @if($b->gambar)
                            <img src="{{ $b->gambar_url }}" alt="{{ $b->nama }}" class="w-full h-full object-cover">
                        @else
                            <span class="text-slate-600 text-sm">Tidak ada gambar</span>
                        @endif
                    </div>

                    <div class="p-5 flex-1 flex flex-col">
                        <div class="flex items-start justify-between gap-3">
                            <h4 class="text-lg font-bold text-white">{{ $b->nama }}</h4>
                            <span class="text-xs font-semibold px-2 py-1 rounded-full {{ $b->stock > 0 ? 'bg-emerald-600/20 text-emerald-300 border border-emerald-500/40' : 'bg-red-600/20 text-red-300 border border-red-500/40' }}">
                                {{ $b->stock > 0 ? 'Tersedia' : 'Habis' }}
                            </span>
                        </div>

                        <p class="text-slate-400 text-sm mt-2 flex-1">{{ $b->keterangan ?: 'Tidak ada keterangan' }}</p>

                        <div class="mt-4 flex items-center justify-between">
                            <p class="text-sm text-slate-300">Stok: <span class="font-bold text-white">{{ $b->stock }}</span></p>
                            @if($b->stock > 0)
                                <a href="{{ route('siswa.pinjam.form', $b->id) }}" class="inline-flex items-center justify-center rounded-xl bg-blue-600 hover:bg-blue-700 px-4 py-2 text-xs font-bold uppercase tracking-wider text-white">
                                    Pinjam
                                </a>
                            @else
                                <span class="inline-flex items-center justify-center rounded-xl bg-slate-800 px-4 py-2 text-xs font-bold uppercase tracking-wider text-slate-500">
                                    Tidak Tersedia
                                </span>
                            @endif
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
    </section>
</div>
@endsection
