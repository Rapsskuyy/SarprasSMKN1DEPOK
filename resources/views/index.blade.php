<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sarpas SMKN 1 Depok</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <nav class="navbar">
        <div class="container nav-inner">
            <a href="/" class="brand">
                <img src="{{ asset('img/logo.svg') }}" alt="Logo SMKN 1 Depok" class="brand-logo">
                <div class="brand-text">
                    <h2>SMKN 1 Depok</h2>
                    <small>Sarana & Prasarana (SARPAS)</small>
                </div>
            </a>
            <ul class="nav-links">
                <li><a href="#">Beranda</a></li>
                <li><a href="#items">Daftar Barang</a></li>
                <li><a href="/login" class="btn btn-outline">Login</a></li>
            </ul>
        </div>
    </nav>

    <header class="hero-section">
        <div class="container hero-inner">
            <div class="hero-text">
                <h1>Peminjaman Sarana & Prasarana</h1>
                <p>Kelola dan pinjam perangkat sekolah dengan cepat, terkontrol, dan rapi.</p>
                <a href="#items" class="btn btn-primary">Lihat Katalog Barang</a>
            </div>
            <div class="hero-illustration">
                <img src="{{ asset('img/logo.svg') }}" alt="Logo" class="hero-logo">
            </div>
        </div>
    </header>

    <main class="container">
        <section id="items" class="inventory-section">
            <div class="section-head">
                <h2>Daftar Barang</h2>
                <p class="muted">Pilih barang yang ingin dipinjam. Status dan sisa stok ditampilkan secara real-time.</p>
            </div>

            <div class="inventory-grid">
                @if(isset($barang) && count($barang) > 0)
                    @foreach($barang as $b)
                        <div class="item-card" data-id="{{ $b->id }}" data-stock="{{ $b->stock }}">
                            <div class="card-media">
                                <div class="item-icon"><i class="fas fa-box-open"></i></div>
                                <img src="{{ asset('img/item-placeholder.svg') }}" alt="{{ $b->nama }}" class="thumb"/>
                            </div>
                            <div class="card-body">
                                <h3 class="item-title">{{ $b->nama }}</h3>
                                <p class="item-desc">{{ $b->keterangan ?? '—' }}</p>
                                <p class="item-stock">Sisa Stok: <strong class="stock-value">{{ $b->stock }}</strong></p>
                            </div>
                            <div class="card-actions">
                                @if($b->stock > 0)
                                    <button class="btn btn-primary btn-borrow">Pinjam</button>
                                @else
                                    <button class="btn btn-disabled" disabled>Habis</button>
                                @endif
                                <a href="/admin/barang/{{ $b->id }}" class="btn btn-outline">Kelola</a>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="empty-state">
                        <p>Tidak ada barang terdaftar. Harap hubungi admin.</p>
                    </div>
                @endif
            </div>
        </section>
    </main>

    <div id="borrow-modal" class="modal" aria-hidden="true">
        <div class="modal-panel">
            <button class="modal-close" aria-label="Close">&times;</button>
            <h3>Form Peminjaman</h3>
            <form id="borrow-form">
                <input type="hidden" name="item_id" id="modal-item-id">
                <div class="form-row">
                    <label>Nama Peminjam</label>
                    <input type="text" name="name" id="peminjam-name" required>
                </div>
                <div class="form-row two-col">
                    <div>
                        <label>Jumlah</label>
                        <input type="number" name="qty" id="peminjam-qty" min="1" value="1" required>
                    </div>
                    <div>
                        <label>Tanggal Kembali</label>
                        <input type="date" name="return_date" id="peminjam-return" required>
                    </div>
                </div>
                <div class="form-row">
                    <label>Keperluan / Keterangan</label>
                    <textarea name="note" id="peminjam-note"></textarea>
                </div>
                <div class="form-row actions">
                    <button type="submit" class="btn btn-primary">Kirim Permintaan</button>
                    <button type="button" class="btn btn-outline modal-close">Batal</button>
                </div>
            </form>
        </div>
    </div>

    <div id="toast" class="toast" aria-hidden="true"></div>

    <script src="{{ asset('js/script.js') }}"></script>
</body>
</html>
