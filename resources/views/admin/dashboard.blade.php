@extends('layouts.app')

@section('content')
<div class="space-y-10">
    <!-- Header Stats -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-slate-900 border border-slate-800 p-6 rounded-2xl shadow-2xl">
            <div class="text-slate-500 text-[10px] font-black uppercase tracking-[0.2em] mb-2">Total Inventaris</div>
            <div class="text-3xl font-black text-white">{{ $barang->count() }}</div>
        </div>
        <div class="bg-slate-900 border border-slate-800 p-6 rounded-2xl shadow-2xl">
            <div class="text-slate-500 text-[10px] font-black uppercase tracking-[0.2em] mb-2">Peminjaman Aktif</div>
            <div class="text-3xl font-black text-blue-500">{{ $activePeminjaman->count() }}</div>
        </div>
    </div>

    <!-- Active Monitoring -->
    <section id="active-monitoring">
        <div class="flex items-center justify-between mb-8">
            <h2 class="text-2xl font-black text-white flex items-center gap-3">
                <span class="w-2 h-8 bg-blue-600 rounded-full"></span>
                Peminjaman Aktif
            </h2>
            <a href="{{ route('admin.history') }}" class="inline-flex items-center gap-2 bg-slate-800/50 hover:bg-slate-700 text-white px-3 py-1.5 rounded-lg text-[9px] font-black uppercase tracking-widest transition-all border border-slate-700 shadow-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                Lihat Riwayat
            </a>
        </div>
        
        <div class="bg-slate-900 border border-slate-800 rounded-3xl overflow-hidden shadow-2xl">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-800/50">
                            <th class="px-8 py-5 text-slate-400 font-black text-[10px] uppercase tracking-widest">Peminjam</th>
                            <th class="px-8 py-5 text-slate-400 font-black text-[10px] uppercase tracking-widest">Barang</th>
                            <th class="px-8 py-5 text-slate-400 font-black text-[10px] uppercase tracking-widest">Waktu</th>
                            <th class="px-8 py-5 text-slate-400 font-black text-[10px] uppercase tracking-widest text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-800">
                        @forelse($activePeminjaman as $p)
                        <tr class="hover:bg-slate-800/30 transition-colors">
                            <td class="px-8 py-5">
                                <div class="font-bold text-white">{{ $p->nama_peminjam }}</div>
                                <div class="text-[10px] text-slate-500 uppercase tracking-tighter">{{ $p->user->username }}</div>
                            </td>
                            <td class="px-8 py-5">
                                <div class="flex items-center gap-3">
                                    <span class="bg-blue-900/30 text-blue-400 px-3 py-1 rounded-full border border-blue-800/50 text-[10px] font-black uppercase tracking-widest">{{ $p->barang->nama }}</span>
                                    <span class="text-slate-500 font-black">×{{ $p->qty }}</span>
                                </div>
                            </td>
                            <td class="px-8 py-5">
                                <div class="flex flex-col">
                                    <span class="text-blue-500 font-mono text-sm">{{ $p->jam_pinjam }}</span>
                                    <span class="text-[10px] text-slate-500 uppercase">{{ $p->guru_pembimbing }}</span>
                                </div>
                            </td>
                            <td class="px-8 py-5 text-right">
                                <form action="{{ route('admin.peminjaman.kembali', $p->id) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all shadow-lg shadow-blue-900/20 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-offset-2 focus:ring-offset-slate-900" onclick="this.disabled=true;this.form.submit();">
                                        Kembalikan
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-8 py-16 text-center text-slate-600 italic font-medium">Belum ada peminjaman aktif saat ini.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <!-- Stock Management -->
    <section id="stock-management">
        <div class="flex items-center justify-between mb-8">
            <h2 class="text-2xl font-black text-white flex items-center gap-3">
                <span class="w-2 h-8 bg-emerald-600 rounded-full"></span>
                Kelola Inventaris
            </h2>
            <button onclick="document.getElementById('modal-add').classList.remove('hidden')" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-2xl text-[10px] font-black uppercase tracking-widest transition-all shadow-lg shadow-blue-900/20">
                + Tambah Barang
            </button>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach($barang as $b)
            <div class="bg-slate-900 border border-slate-800 rounded-3xl overflow-hidden shadow-2xl hover:border-slate-700 transition-all group flex flex-col">
                <div class="h-40 bg-slate-800 flex items-center justify-center relative overflow-hidden">
                    @if($b->gambar)
                        <img src="{{ $b->gambar_url }}" alt="{{ $b->nama }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    @else
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-slate-700 group-hover:text-blue-500/20 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                    @endif
                    <div class="absolute top-3 right-3 flex gap-2">
                        <button onclick="editBarang({{ $b }}, false)" class="p-2 bg-slate-950/80 backdrop-blur-md text-slate-400 hover:text-white rounded-xl transition-colors border border-slate-800">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor"><path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" /></svg>
                        </button>
                        <form action="{{ route('admin.barang.destroy', $b->id) }}" method="POST" onsubmit="return confirm('Hapus barang ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="p-2 bg-slate-950/80 backdrop-blur-md text-slate-400 hover:text-red-500 rounded-xl transition-colors border border-slate-800">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" /></svg>
                            </button>
                        </form>
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="text-lg font-bold text-white mb-1">{{ $b->nama }}</h3>
                    <p class="text-[10px] text-slate-500 mb-6 line-clamp-2 h-8 leading-relaxed uppercase tracking-widest font-bold">{{ $b->keterangan }}</p>
                    
                    <div class="space-y-4">
                        <div class="flex items-center justify-between bg-slate-950/50 p-4 rounded-2xl border border-slate-800/50">
                            <span class="text-[10px] font-black text-slate-600 uppercase tracking-widest">Stock</span>
                            <div class="flex items-center gap-3">
                                <button type="button" onclick="quickUpdateStock({{ $b->id }}, -1, this)" class="stock-btn w-8 h-8 flex items-center justify-center bg-slate-800 hover:bg-slate-700 text-slate-400 hover:text-white rounded-lg transition-all border border-slate-700 focus:outline-none focus:ring-2 focus:ring-blue-500 disabled:opacity-50 disabled:cursor-not-allowed" aria-label="Kurangi stok {{ $b->nama }}">-</button>
                                <span id="stock-display-{{ $b->id }}" class="text-xl font-black {{ $b->stock > 0 ? 'text-blue-500' : 'text-red-500' }} min-w-[2ch] text-center" aria-live="polite">{{ $b->stock }}</span>
                                <button type="button" onclick="quickUpdateStock({{ $b->id }}, 1, this)" class="stock-btn w-8 h-8 flex items-center justify-center bg-slate-800 hover:bg-slate-700 text-slate-400 hover:text-white rounded-lg transition-all border border-slate-700 focus:outline-none focus:ring-2 focus:ring-blue-500 disabled:opacity-50 disabled:cursor-not-allowed" aria-label="Tambah stok {{ $b->nama }}">+</button>
                            </div>
                        </div>

                        <button onclick="editBarang({{ $b }}, false)" class="w-full py-3 bg-slate-800/50 hover:bg-slate-800 text-slate-400 hover:text-blue-400 rounded-xl text-[10px] font-black uppercase tracking-[0.2em] transition-all border border-slate-800">
                            Detail & Edit
                        </button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>
</div>

<!-- Modal Add -->
<div id="modal-add" class="fixed inset-0 bg-slate-950/90 backdrop-blur-md z-[100] flex items-center justify-center hidden p-4">
    <div class="bg-slate-900 border border-slate-800 w-full max-w-lg p-10 rounded-3xl shadow-2xl">
        <h2 class="text-2xl font-black text-white mb-8 tracking-tight">Tambah Inventaris</h2>
        <form action="{{ route('admin.barang.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            <div>
                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2">Nama Barang</label>
                <input type="text" name="nama" class="w-full bg-slate-950 border border-slate-800 rounded-2xl px-5 py-3 text-white focus:ring-2 focus:ring-blue-500 outline-none transition-all" required>
            </div>
            <div>
                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2">Keterangan</label>
                <textarea name="keterangan" class="w-full bg-slate-950 border border-slate-800 rounded-2xl px-5 py-3 text-white focus:ring-2 focus:ring-blue-500 outline-none transition-all h-24"></textarea>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2">Stok Awal</label>
                    <input type="number" name="stock" class="w-full bg-slate-950 border border-slate-800 rounded-2xl px-5 py-3 text-white focus:ring-2 focus:ring-blue-500 outline-none transition-all" required>
                </div>
                <div>
                    <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2">Lokasi</label>
                    <input type="text" name="lokasi" class="w-full bg-slate-950 border border-slate-800 rounded-2xl px-5 py-3 text-white focus:ring-2 focus:ring-blue-500 outline-none transition-all">
                </div>
            </div>
            <div>
                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2">Foto Barang</label>
                <input type="file" name="gambar" class="w-full text-sm text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-[10px] file:font-black file:uppercase file:bg-slate-800 file:text-blue-400 hover:file:bg-slate-700 transition-all cursor-pointer">
            </div>
            <div class="flex justify-end gap-4 pt-4">
                <button type="button" onclick="document.getElementById('modal-add').classList.add('hidden')" class="px-6 py-3 text-slate-500 hover:text-white font-bold transition-colors">Batal</button>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-2xl font-black uppercase tracking-widest text-[10px] transition-all shadow-lg shadow-blue-900/20">Simpan Barang</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Edit -->
<div id="modal-edit" class="fixed inset-0 bg-slate-950/90 backdrop-blur-md z-[100] flex items-center justify-center hidden p-4">
    <div class="bg-slate-900 border border-slate-800 w-full max-w-lg p-10 rounded-3xl shadow-2xl">
        <h2 class="text-2xl font-black text-white mb-8 tracking-tight">Edit Inventaris</h2>
        <form id="form-edit" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf @method('PUT')
            <div>
                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2">Nama Barang</label>
                <input type="text" name="nama" id="edit-nama" class="w-full bg-slate-950 border border-slate-800 rounded-2xl px-5 py-3 text-white focus:ring-2 focus:ring-blue-500 outline-none transition-all" required>
            </div>
            <div>
                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2">Keterangan</label>
                <textarea name="keterangan" id="edit-keterangan" class="w-full bg-slate-950 border border-slate-800 rounded-2xl px-5 py-3 text-white focus:ring-2 focus:ring-blue-500 outline-none transition-all h-24"></textarea>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2">Stok Unit</label>
                    <input type="number" name="stock" id="edit-stock" class="w-full bg-slate-950 border border-slate-800 rounded-2xl px-5 py-3 text-white focus:ring-2 focus:ring-blue-500 outline-none transition-all" required>
                </div>
                <div>
                    <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2">Lokasi</label>
                    <input type="text" name="lokasi" id="edit-lokasi" class="w-full bg-slate-950 border border-slate-800 rounded-2xl px-5 py-3 text-white focus:ring-2 focus:ring-blue-500 outline-none transition-all">
                </div>
            </div>
            <div>
                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2">Ganti Foto Barang (Opsional)</label>
                <input type="file" name="gambar" class="w-full text-sm text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-[10px] file:font-black file:uppercase file:bg-slate-800 file:text-blue-400 hover:file:bg-slate-700 transition-all cursor-pointer">
            </div>
            <div class="flex justify-end gap-4 pt-4">
                <button type="button" onclick="document.getElementById('modal-edit').classList.add('hidden')" class="px-6 py-3 text-slate-500 hover:text-white font-bold transition-colors">Batal</button>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-2xl font-black uppercase tracking-widest text-[10px] transition-all shadow-lg shadow-blue-900/20">Perbarui Data</button>
            </div>
        </form>
    </div>
</div>

<script>
    function quickUpdateStock(id, change, btnEl) {
        const display = document.getElementById('stock-display-' + id);
        const card = btnEl.closest('.bg-slate-900');
        const btns = card ? card.querySelectorAll('.stock-btn') : document.querySelectorAll('.stock-btn');
        const currentStock = parseInt(display.innerText, 10);
        const newStock = Math.max(0, currentStock + change);
        
        btns.forEach(b => { b.disabled = true; });
        display.innerText = newStock;
        display.className = `text-xl font-black ${newStock > 0 ? 'text-blue-500' : 'text-red-500'} min-w-[2ch] text-center`;

        fetch(`/admin/barang/${id}/stock`, {
            method: 'PATCH',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ change: change })
        })
        .then(response => response.json())
        .then(data => {
            if (!data.success) {
                display.innerText = currentStock;
                display.className = `text-xl font-black ${currentStock > 0 ? 'text-blue-500' : 'text-red-500'} min-w-[2ch] text-center`;
                alert('Gagal memperbarui stok');
            }
        })
        .catch(() => {
            display.innerText = currentStock;
            display.className = `text-xl font-black ${currentStock > 0 ? 'text-blue-500' : 'text-red-500'} min-w-[2ch] text-center`;
            alert('Gagal memperbarui stok');
        })
        .finally(() => btns.forEach(b => b.disabled = false));
    }

    function editBarang(barang, focusStock = false) {
        document.getElementById('form-edit').action = '/admin/barang/' + barang.id;
        document.getElementById('edit-nama').value = barang.nama;
        document.getElementById('edit-keterangan').value = barang.keterangan;
        document.getElementById('edit-stock').value = barang.stock;
        document.getElementById('edit-lokasi').value = barang.lokasi;
        document.getElementById('modal-edit').classList.remove('hidden');

        if (focusStock) {
            setTimeout(() => {
                document.getElementById('edit-stock').focus();
            }, 100);
        }
    }
</script>
@endsection
