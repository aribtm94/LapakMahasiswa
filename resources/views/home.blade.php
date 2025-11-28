@extends('layouts.app')

@section('title', 'LapakMahasiswa - Marketplace Mahasiswa')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Header -->
    <header class="flex items-center justify-between py-6">
        <div class="text-3xl font-bold font-display text-text-light dark:text-text-dark">
            LapakMahasiswa
        </div>
        
        <!-- Search Bar -->
        <div class="relative flex-grow max-w-xl mx-4">
            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">search</span>
            <input 
                class="w-full pl-10 pr-4 py-2 bg-surface-light dark:bg-surface-dark border-none rounded-lg text-text-light dark:text-text-dark placeholder-gray-500 dark:placeholder-gray-400 focus:ring-2 focus:ring-primary focus:ring-opacity-50" 
                placeholder="Cari di LapakMahasiswa" 
                type="text"
            />
        </div>
        
        <!-- Action Buttons -->
        <div class="flex items-center space-x-4">
            <button class="relative p-2 text-text-light dark:text-text-dark hover:bg-gray-100 dark:hover:bg-gray-800 rounded-full">
                <span class="material-symbols-outlined">shopping_cart</span>
                <span class="absolute -top-1 -right-1 flex h-5 w-5 items-center justify-center rounded-full bg-primary text-xs font-bold text-black">+</span>
            </button>
            
            @auth
                <a href="{{ route('dashboard') }}" class="px-6 py-2 bg-primary text-black rounded-full font-semibold hover:opacity-90 transition-opacity">
                    Dashboard
                </a>
            @else
                <a href="{{ route('login') }}" class="px-6 py-2 border border-primary text-primary rounded-full font-semibold hover:bg-primary hover:text-white transition-colors">
                    Masuk
                </a>
                <a href="{{ route('register') }}" class="px-6 py-2 bg-primary text-black rounded-full font-semibold hover:opacity-90 transition-opacity">
                    Daftar
                </a>
            @endauth
        </div>
    </header>

    <!-- Main Content -->
    <main class="mt-8 pb-12">
        <!-- Hero Section -->
        <section class="bg-primary rounded-2xl p-8 md:p-12 flex flex-col md:flex-row items-center justify-between">
            <div class="text-black text-center md:text-left mb-8 md:mb-0">
                <h1 class="text-3xl md:text-4xl font-bold font-display">
                    Males Belanja offline?
                </h1>
                <p class="text-2xl md:text-3xl font-bold font-display mt-2">
                    Yuk pakai LapakMahasiswa aja!!!!
                </p>
                <button class="mt-8 px-8 py-3 bg-white text-black font-semibold rounded-full shadow-md hover:bg-gray-100 transition-colors">
                    Cek Sekarang
                </button>
            </div>
            <div>
                <img 
                    alt="Ilustrasi belanja" 
                    class="w-64 h-auto md:w-96" 
                    src="/images/hero-illustration.png"
                    onerror="this.style.display='none'"
                />
            </div>
        </section>

        <!-- Kategori Pilihan Section -->
        <section class="mt-12 border border-border-light dark:border-border-dark rounded-2xl p-8">
            <h2 class="text-2xl font-bold font-serif mb-6 text-text-light dark:text-text-dark">
                Kategori Pilihan
            </h2>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-6 text-center">
                @php
                    $categories = [
                        ['name' => 'Akademik', 'image' => '/images/categories/akademik.png'],
                        ['name' => 'Elektronik', 'image' => '/images/categories/elektronik.png'],
                        ['name' => 'Fashion', 'image' => '/images/categories/fashion.png'],
                        ['name' => 'Makanan', 'image' => '/images/categories/makanan.png'],
                        ['name' => 'Rumahan', 'image' => '/images/categories/rumahan.png'],
                    ];
                @endphp

                @foreach($categories as $category)
                <div class="flex flex-col items-center cursor-pointer group">
                    <div class="w-full aspect-square border border-border-light dark:border-border-dark rounded-2xl p-4 flex items-center justify-center bg-white group-hover:shadow-lg transition-shadow">
                        <img 
                            alt="{{ $category['name'] }}" 
                            class="max-w-full max-h-full object-contain" 
                            src="{{ $category['image'] }}"
                            onerror="this.parentElement.innerHTML='<span class=\'material-symbols-outlined text-6xl text-gray-300\'>category</span>'"
                        />
                    </div>
                    <span class="mt-3 text-lg font-serif font-semibold text-text-light dark:text-text-dark">
                        {{ $category['name'] }}
                    </span>
                </div>
                @endforeach
            </div>
        </section>

        <!-- Daftar Jadi Penjual Section -->
        <section class="mt-12 bg-gradient-to-r from-blue-500 to-purple-600 rounded-2xl p-8 md:p-12">
            <div class="flex flex-col md:flex-row items-center justify-between">
                <div class="text-white text-center md:text-left mb-6 md:mb-0">
                    <h2 class="text-3xl md:text-4xl font-black font-display">
                        Ingin Mulai Berjualan?
                    </h2>
                    <p class="mt-3 text-lg text-white/80 max-w-md">
                        Bergabunglah dengan ribuan mahasiswa lain dan mulailah perjalanan wirausaha Anda di LapakMahasiswa!
                    </p>
                    <div class="flex flex-wrap gap-4 mt-4 justify-center md:justify-start">
                        <div class="flex items-center gap-2 text-white/90">
                            <span class="material-symbols-outlined text-sm">check_circle</span>
                            <span class="text-sm">Gratis Pendaftaran</span>
                        </div>
                        <div class="flex items-center gap-2 text-white/90">
                            <span class="material-symbols-outlined text-sm">check_circle</span>
                            <span class="text-sm">Jangkauan Luas</span>
                        </div>
                        <div class="flex items-center gap-2 text-white/90">
                            <span class="material-symbols-outlined text-sm">check_circle</span>
                            <span class="text-sm">Mudah Dikelola</span>
                        </div>
                    </div>
                </div>
                <a href="{{ route('seller.register') }}" class="px-8 py-4 bg-white text-purple-600 font-bold rounded-full shadow-lg hover:bg-gray-100 transition-colors flex items-center gap-2">
                    <span class="material-symbols-outlined">storefront</span>
                    Daftar Jadi Penjual
                </a>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="py-8 border-t border-gray-200">
        <div class="text-center text-gray-500 text-sm">
            &copy; {{ date('Y') }} LapakMahasiswa. All rights reserved.
        </div>
    </footer>
</div>
@endsection
