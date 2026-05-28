<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Sistem Informasi Peminjaman Sarana dan Prasarana (SARPRAS) SMKN 1 Depok">
    <title>@yield('title', config('app.name', 'Sarpras SMKN 1 Depok'))</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-950 text-slate-200 min-h-screen font-sans antialiased">
    <a href="#main-content" class="absolute left-4 -top-full focus:top-4 focus:z-[60] px-4 py-2 bg-blue-600 text-white rounded-lg outline-none focus:ring-2 focus:ring-blue-400 transition-all duration-200">
        Lewati ke konten utama
    </a>
    <nav class="bg-slate-900 border-b border-slate-800 sticky top-0 z-50" role="navigation" aria-label="Navigasi utama">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex items-center gap-3">
                    <img src="{{ asset('img/smkn1depoklogo.jpg') }}" alt="Logo SMKN 1 Depok" class="h-10 w-auto">
                    <span class="text-xl font-bold tracking-tight text-white uppercase">SARPRAS SMKN 1 DEPOK</span>
                </div>
                <div class="flex items-center gap-4">
                    @auth
                        <span class="text-slate-400 text-sm">Halo, <span class="text-blue-400 font-medium">{{ Auth::user()->name }}</span></span>
                        @can('admin')
                            <a href="{{ route('admin.index') }}" class="text-slate-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium transition-colors">Admin Panel</a>
                        @endcan
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 focus:ring-offset-slate-900" aria-label="Keluar dari akun">Keluar</button>
                        </form>
                    @else
                        <a href="{{ route('register') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">Akses Web</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <header class="bg-blue-600 py-16 flex items-center justify-center shadow-2xl">
        <div class="relative text-center px-4">
            <h1 class="text-4xl md:text-5xl font-black text-white tracking-tight drop-shadow-xl">Sistem Informasi Sarana & Prasarana</h1>
            <p class="mt-2 text-blue-100 text-lg font-bold tracking-[0.3em] uppercase opacity-90">SMK Negeri 1 Depok</p>
        </div>
    </header>

    <main id="main-content" class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8" role="main">
        @if(session('success'))
            <div class="mb-4 p-4 bg-emerald-900/50 border border-emerald-800 text-emerald-300 rounded-xl flex items-center gap-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg>
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="mb-4 p-4 bg-red-900/50 border border-red-800 text-red-300 rounded-xl flex items-center gap-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" /></svg>
                {{ session('error') }}
            </div>
        @endif
        @if($errors->any())
            <div class="mb-4 p-4 bg-red-900/50 border border-red-800 text-red-200 rounded-xl">
                <p class="font-semibold mb-2">Terjadi kesalahan:</p>
                <ul class="list-disc pl-5 space-y-1 text-sm">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        @yield('content')
    </main>

    <footer class="bg-slate-900 border-t border-slate-800 pt-16 pb-8 mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12 mb-12">
                <div class="space-y-4">
                    <div class="flex items-center gap-3">
                        <img src="{{ asset('img/smkn1depoklogo.jpg') }}" alt="Logo SMKN 1 Depok" class="h-12 w-auto grayscale brightness-200">
                        <span class="text-xl font-black text-white">SMKN 1 DEPOK</span>
                    </div>
                    <p class="text-slate-500 text-sm leading-relaxed">
                        Sistem Informasi Peminjaman Sarana dan Prasarana (SARPRAS) SMKN 1 Depok. Memberikan kemudahan dalam pengelolaan dan peminjaman inventaris sekolah.
                    </p>
                </div>
                
                <div class="space-y-4">
                    <h3 class="text-white font-bold text-lg">Kontak Kami</h3>
                    <ul class="space-y-3 text-slate-400 text-sm">
                        <li class="flex items-start gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                            <span>Gang Bhakti Suci No.100, Cimpaeun, Tapos, Kota Depok, Jawa Barat, 16459</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" /></svg>
                            <span>021-8790-7233 (Call)</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                            <span>smkn1depok@gmail.com</span>
                        </li>
                    </ul>
                </div>

                <div class="space-y-4">
                    <h3 class="text-white font-bold text-lg">Media Sosial</h3>
                    <div class="flex flex-col gap-3 text-slate-400 text-sm">
                        <a href="#" class="hover:text-blue-400 flex items-center gap-3 transition-colors">
                            <span class="bg-slate-800 p-2 rounded-lg text-blue-500">IG</span>
                            officialsmkn1depok
                        </a>
                        <a href="#" class="hover:text-blue-400 flex items-center gap-3 transition-colors">
                            <span class="bg-slate-800 p-2 rounded-lg text-blue-500">YT</span>
                            OfficialSMKN1Depok
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="border-t border-slate-800 pt-8 text-center text-slate-600 text-[10px] font-black uppercase tracking-[0.2em]">
                &copy; {{ date('Y') }} SMKN 1 DEPOK • SARPRAS DIGITAL ENVIRONMENT
            </div>
        </div>
    </footer>
</body>
</html>
