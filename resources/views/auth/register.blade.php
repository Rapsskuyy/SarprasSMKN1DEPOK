@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto bg-slate-900 border border-slate-800 p-8 rounded-2xl shadow-xl transition-all" id="auth-card">
    <div class="text-center mb-8">
        <h2 class="text-3xl font-bold text-white" id="auth-title">Akses Web Sarpras</h2>
        <p class="text-slate-400 mt-2" id="auth-subtitle">Daftar atau masuk untuk meminjam barang</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <!-- Field Nama (Hanya untuk Register) -->
        <div id="field-name">
            <label class="block text-sm font-medium text-slate-300 mb-1"> Nama Lengkap</label>
            <input type="text" name="name" value="{{ old('name') }}" class="w-full bg-slate-950 border border-slate-700 rounded-xl px-4 py-2 text-white focus:ring-2 focus:ring-blue-500 transition-all">
            @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-slate-300 mb-1" for="username">Username</label>
            <input type="text" name="username" id="username" value="{{ old('username') }}" class="w-full bg-slate-950 border border-slate-700 rounded-xl px-4 py-2 text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-600 transition-all outline-none" required autocomplete="username">
            @error('username') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <!-- Field Email (Hanya untuk Register) -->
        <div id="field-email">
            <label class="block text-sm font-medium text-slate-300 mb-1">Gmail</label>
            <input type="email" name="email" value="{{ old('email') }}" class="w-full bg-slate-950 border border-slate-700 rounded-xl px-4 py-2 text-white focus:ring-2 focus:ring-blue-500 transition-all">
            @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <!-- Field Role (Hanya untuk Register) -->
        <div id="field-role">
            <label class="block text-sm font-medium text-slate-300 mb-1">Masuk Sebagai</label>
            <select name="role" class="w-full bg-slate-950 border border-slate-700 rounded-xl px-4 py-2 text-white focus:ring-2 focus:ring-blue-500 transition-all">
                <option value="siswa">Siswa</option>
                <option value="admin">Admin</option>
            </select>
            @error('role') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-slate-300 mb-1" for="password">Password</label>
            <input type="password" name="password" id="password" class="w-full bg-slate-950 border border-slate-700 rounded-xl px-4 py-2 text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-600 transition-all outline-none" required autocomplete="{{ $errors->has('password') && !$errors->has('name') ? 'current-password' : 'new-password' }}">
            @error('password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <!-- Field Confirm (Hanya untuk Register) -->
        <div id="field-confirm">
            <label class="block text-sm font-medium text-slate-300 mb-1">Konfirmasi Password</label>
            <input type="password" name="password_confirmation" class="w-full bg-slate-950 border border-slate-700 rounded-xl px-4 py-2 text-white focus:ring-2 focus:ring-blue-500 transition-all">
        </div>

        <button type="submit" id="auth-button" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-xl shadow-lg shadow-blue-900/20 transition-all transform hover:scale-[1.02] mt-4">
            Daftar & Masuk
        </button>
    </form>

    <div class="mt-6 text-center text-sm text-slate-400">
        <span id="toggle-text">Sudah punya akun?</span>
        <button type="button" onclick="toggleAuth()" id="toggle-btn" class="text-blue-400 hover:text-blue-300 font-medium ml-1">Klik di sini</button>
    </div>
</div>

<script>
    let isLogin = false;

    function toggleAuth() {
        isLogin = !isLogin;

        const fieldsToToggle = ['field-name', 'field-email', 'field-role', 'field-confirm'];
        const title = document.getElementById('auth-title');
        const subtitle = document.getElementById('auth-subtitle');
        const button = document.getElementById('auth-button');
        const toggleText = document.getElementById('toggle-text');
        const toggleBtn = document.getElementById('toggle-btn');

        fieldsToToggle.forEach(id => {
            const el = document.getElementById(id);
            if (isLogin) {
                el.classList.add('hidden');
                el.querySelector('input, select')?.removeAttribute('required');
            } else {
                el.classList.remove('hidden');
                if (id !== 'field-confirm') el.querySelector('input, select')?.setAttribute('required', '');
            }
        });

        if (isLogin) {
            title.innerText = 'Login ke Web Sarpras';
            subtitle.innerText = 'Masukkan username dan password Anda';
            button.innerText = 'Masuk Sekarang';
            toggleText.innerText = 'Belum punya akun?';
            toggleBtn.innerText = 'Daftar di sini';
        } else {
            title.innerText = 'Akses Web Sarpras';
            subtitle.innerText = 'Daftar atau masuk untuk meminjam barang';
            button.innerText = 'Daftar & Masuk';
            toggleText.innerText = 'Sudah punya akun?';
            toggleBtn.innerText = 'Klik di sini';
        }
    }

    @if($errors->has('password') && !$errors->has('name'))
        toggleAuth();
    @endif
</script>
@endsection
