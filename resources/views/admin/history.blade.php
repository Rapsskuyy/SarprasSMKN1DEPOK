@extends('layouts.app')

@section('content')
<div class="space-y-10">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h2 class="text-3xl font-black text-white tracking-tight flex items-center gap-3">
                <span class="w-2 h-8 bg-purple-600 rounded-full"></span>
                Riwayat Peminjaman
            </h2>
            <p class="text-slate-400 mt-1">Laporan lengkap riwayat pengembalian barang sarana & prasarana.</p>
        </div>
        <a href="{{ route('admin.index') }}" class="inline-flex items-center gap-2 bg-slate-800 hover:bg-slate-700 text-white px-6 py-3 rounded-2xl text-[10px] font-black uppercase tracking-widest transition-all border border-slate-700 shadow-xl">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
            Kembali ke Dashboard
        </a>
    </div>

    <!-- History Table -->
    <section id="history">
        <div class="bg-slate-900 border border-slate-800 rounded-3xl overflow-hidden shadow-2xl">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-800/50">
                            <th class="px-8 py-5 text-slate-400 font-black text-[10px] uppercase tracking-widest">Peminjam</th>
                            <th class="px-8 py-5 text-slate-400 font-black text-[10px] uppercase tracking-widest">Barang</th>
                            <th class="px-8 py-5 text-slate-400 font-black text-[10px] uppercase tracking-widest">Waktu Pinjam & Kembali</th>
                            <th class="px-8 py-5 text-slate-400 font-black text-[10px] uppercase tracking-widest">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-800">
                        @forelse($historyPeminjaman as $p)
                        <tr class="hover:bg-slate-800/30 transition-colors">
                            <td class="px-8 py-5">
                                <div class="font-bold text-white">{{ $p->nama_peminjam }}</div>
                                <div class="text-[10px] text-slate-500 uppercase tracking-tighter">{{ $p->created_at->format('d M Y') }}</div>
                            </td>
                            <td class="px-8 py-5 text-slate-400 font-medium">
                                <div class="flex items-center gap-2">
                                    <span class="text-white">{{ $p->barang->nama }}</span>
                                    <span class="bg-slate-800 px-2 py-0.5 rounded text-[10px] font-black text-slate-500 border border-slate-700">×{{ $p->qty }}</span>
                                </div>
                            </td>
                            <td class="px-8 py-5">
                                <div class="flex items-center gap-3 text-sm">
                                    <div class="flex flex-col">
                                        <span class="text-[10px] text-slate-500 uppercase font-black">Pinjam</span>
                                    <span class="text-blue-400 font-mono">{{ $p->jam_pinjam }}</span>
                                    </div>
                                    <span class="text-slate-700 mt-3">→</span>
                                    <div class="flex flex-col">
                                        <span class="text-[10px] text-slate-500 uppercase font-black">Kembali</span>
                                        <span class="text-emerald-400 font-mono">{{ $p->jam_kembali }}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="px-8 py-5">
                                <div class="flex items-center gap-2 text-emerald-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg>
                                    <span class="text-[10px] font-black uppercase tracking-widest">Selesai</span>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-8 py-20 text-center">
                                <div class="flex flex-col items-center gap-3 opacity-20">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                    <span class="italic font-medium">Belum ada riwayat peminjaman yang tercatat.</span>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($historyPeminjaman->hasPages())
            <div class="p-8 border-t border-slate-800 bg-slate-900/50">
                {{ $historyPeminjaman->links() }}
            </div>
            @endif
        </div>
    </section>
</div>
@endsection
