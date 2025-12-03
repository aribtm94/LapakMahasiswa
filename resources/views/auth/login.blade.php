<!DOCTYPE html>
<html class="light" lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Masuk - LapakMahasiswa</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com" rel="preconnect"/>
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet"/>
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#24aceb",
                        "background-light": "#f6f7f8",
                        "background-dark": "#111c21",
                    },
                    fontFamily: {
                        "display": ["Plus Jakarta Sans", "sans-serif"]
                    },
                    borderRadius: {
                        "DEFAULT": "0.5rem",
                        "lg": "1rem",
                        "xl": "1.5rem",
                        "full": "9999px"
                    },
                },
            },
        }
    </script>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
    </style>
</head>
<body class="font-display">
    <div class="relative flex min-h-screen w-full bg-background-light dark:bg-background-dark group/design-root overflow-x-hidden">
        <!-- Left Panel - Fixed -->
        <div class="hidden md:flex md:w-[40%] fixed inset-y-0 left-0 flex-col items-start justify-center p-12 bg-primary text-white">
            <a href="{{ url('/') }}" class="absolute top-12 left-12 flex items-center gap-3 hover:opacity-80 transition-opacity">
                <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-white/20">
                    <span class="material-symbols-outlined text-white text-2xl">store</span>
                </div>
                <p class="text-xl font-bold">LapakMahasiswa</p>
            </a>
            <div class="flex flex-col gap-8">
                <div class="flex flex-col gap-4">
                    <h1 class="text-5xl font-black leading-tight tracking-tighter">Selamat Datang Kembali</h1>
                    <p class="text-base font-normal text-white/80 max-w-md">Masuk ke akun Anda untuk mengelola toko dan melihat pesanan dari pelanggan.</p>
                </div>
                <div class="flex flex-col gap-5">
                    <div class="flex items-center gap-4">
                        <div class="flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-white/20">
                            <span class="material-symbols-outlined text-white text-2xl">inventory_2</span>
                        </div>
                        <div>
                            <h3 class="font-bold text-lg">Kelola Produk</h3>
                            <p class="text-sm text-white/70">Tambah, edit, dan kelola produk dengan mudah.</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-white/20">
                            <span class="material-symbols-outlined text-white text-2xl">shopping_bag</span>
                        </div>
                        <div>
                            <h3 class="font-bold text-lg">Pantau Pesanan</h3>
                            <p class="text-sm text-white/70">Lihat dan proses pesanan dari pelanggan.</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-white/20">
                            <span class="material-symbols-outlined text-white text-2xl">analytics</span>
                        </div>
                        <div>
                            <h3 class="font-bold text-lg">Analisis Penjualan</h3>
                            <p class="text-sm text-white/70">Pantau performa toko dengan statistik lengkap.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Right Panel -->
        <div class="w-full md:w-[60%] md:ml-[40%] min-h-screen flex flex-col justify-center py-12 px-6 sm:px-12 lg:px-20 xl:px-32 2xl:px-48 bg-background-light dark:bg-background-dark">
            <div class="w-full max-w-md">
                <div class="flex flex-col gap-3 mb-8">
                    <h2 class="text-[#0e171b] dark:text-white text-4xl font-black leading-tight tracking-[-0.033em]">Masuk ke Akun</h2>
                    <p class="text-[#4d8199] dark:text-gray-400 text-base font-normal leading-normal">Masukkan email dan password Anda</p>
                </div>

                <!-- Status Messages -->
                @if(session('status'))
                    <div class="mb-6 p-4 bg-green-100 dark:bg-green-900/30 border border-green-300 dark:border-green-700 text-green-700 dark:text-green-400 rounded-lg">
                        <div class="flex items-center gap-2">
                            <span class="material-symbols-outlined">check_circle</span>
                            <span>{{ session('status') }}</span>
                        </div>
                    </div>
                @endif

                @if($errors->any())
                    <div class="mb-6 p-4 bg-red-100 dark:bg-red-900/30 border border-red-300 dark:border-red-700 text-red-700 dark:text-red-400 rounded-lg">
                        <div class="flex items-start gap-2">
                            <span class="material-symbols-outlined">error</span>
                            <ul class="list-disc list-inside">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="flex flex-col gap-6">
                    @csrf
                    <!-- Email -->
                    <label class="flex flex-col">
                        <p class="text-[#0e171b] dark:text-gray-300 text-base font-medium leading-normal pb-2">Email</p>
                        <input name="email" value="{{ old('email') }}" class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-[#0e171b] dark:text-white focus:outline-0 focus:ring-2 focus:ring-primary/50 border border-[#d0e0e7] dark:border-gray-700 bg-background-light dark:bg-background-dark focus:border-primary h-12 placeholder:text-[#4d8199] px-4 text-base font-normal leading-normal" placeholder="email@contoh.com" required="" type="email" autofocus/>
                    </label>

                    <!-- Password -->
                    <label class="flex flex-col">
                        <p class="text-[#0e171b] dark:text-gray-300 text-base font-medium leading-normal pb-2">Password</p>
                        <input name="password" class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-[#0e171b] dark:text-white focus:outline-0 focus:ring-2 focus:ring-primary/50 border border-[#d0e0e7] dark:border-gray-700 bg-background-light dark:bg-background-dark focus:border-primary h-12 placeholder:text-[#4d8199] px-4 text-base font-normal leading-normal" placeholder="••••••••" required="" type="password"/>
                    </label>

                    <!-- Remember Me & Forgot Password -->
                    <div class="flex items-center justify-between">
                        <label class="flex items-center">
                            <input type="checkbox" name="remember" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary/30 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-primary/60 dark:ring-offset-gray-800">
                            <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">Ingat saya</span>
                        </label>
                        
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-sm text-primary hover:underline">
                                Lupa password?
                            </a>
                        @endif
                    </div>

                    <!-- Submit Button -->
                    <button class="w-full text-white bg-primary hover:opacity-90 focus:ring-4 focus:outline-none focus:ring-primary/30 font-bold rounded-lg text-base px-5 py-3.5 text-center transition-opacity" type="submit">Masuk</button>
                    
                    <p class="text-sm font-light text-gray-500 dark:text-gray-400 text-center">
                        Belum punya akun? <a class="font-medium text-primary hover:underline" href="{{ route('register') }}">Daftar sekarang</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
