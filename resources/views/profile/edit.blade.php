@extends('layouts.app')

@section('title', 'Edit Profil - LapakMahasiswa')

@section('content')
<div class="min-h-screen bg-gray-100 dark:bg-gray-900">
    <!-- Navigation -->
    <nav class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="{{ url('/') }}" class="flex items-center gap-2">
                        <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-primary">
                            <span class="material-symbols-outlined text-white text-lg">store</span>
                        </div>
                        <span class="text-xl font-bold text-gray-800 dark:text-white">LapakMahasiswa</span>
                    </a>
                </div>

                <div class="flex items-center gap-4">
                    <span class="text-gray-700 dark:text-gray-300">{{ Auth::user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
                            <span class="material-symbols-outlined">logout</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <div class="flex">
        <!-- Sidebar -->
        <aside class="w-64 min-h-screen bg-white dark:bg-gray-800 border-r border-gray-200 dark:border-gray-700">
            <nav class="p-4 space-y-2">
                <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 px-4 py-3 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-colors">
                    <span class="material-symbols-outlined">dashboard</span>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('profile.edit') }}" class="flex items-center space-x-3 px-4 py-3 text-primary bg-primary/10 rounded-lg font-medium">
                    <span class="material-symbols-outlined">person</span>
                    <span>Profil</span>
                </a>
                <a href="#" class="flex items-center space-x-3 px-4 py-3 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-colors">
                    <span class="material-symbols-outlined">shopping_bag</span>
                    <span>Pesanan Saya</span>
                </a>
                <a href="#" class="flex items-center space-x-3 px-4 py-3 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-colors">
                    <span class="material-symbols-outlined">favorite</span>
                    <span>Wishlist</span>
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-8">
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white mb-6">Edit Profil</h1>
            
            <div class="space-y-6">
                <!-- Update Profile Information -->
                <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-sm">
                    <h2 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Informasi Profil</h2>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">Update nama dan email Anda.</p>
                    
                    <form method="POST" action="{{ route('profile.update') }}">
                        @csrf
                        @method('PATCH')

                        <div class="grid gap-4 max-w-xl">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nama</label>
                                <input 
                                    type="text" 
                                    id="name" 
                                    name="name" 
                                    value="{{ old('name', $user->name) }}" 
                                    required
                                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary dark:bg-gray-700 dark:text-white"
                                >
                                @error('name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Email</label>
                                <input 
                                    type="email" 
                                    id="email" 
                                    name="email" 
                                    value="{{ old('email', $user->email) }}" 
                                    required
                                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary dark:bg-gray-700 dark:text-white"
                                >
                                @error('email')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <button type="submit" class="px-6 py-2 bg-primary text-white font-semibold rounded-lg hover:opacity-90 transition-opacity">
                                    Simpan
                                </button>
                                
                                @if(session('status') === 'profile-updated')
                                    <span class="ml-3 text-sm text-green-600">Tersimpan.</span>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Update Password -->
                <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-sm">
                    <h2 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Update Password</h2>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">Pastikan menggunakan password yang panjang dan acak.</p>
                    
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf
                        @method('PUT')

                        <div class="grid gap-4 max-w-xl">
                            <div>
                                <label for="current_password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Password Saat Ini</label>
                                <input 
                                    type="password" 
                                    id="current_password" 
                                    name="current_password"
                                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary dark:bg-gray-700 dark:text-white"
                                >
                                @error('current_password', 'updatePassword')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Password Baru</label>
                                <input 
                                    type="password" 
                                    id="password" 
                                    name="password"
                                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary dark:bg-gray-700 dark:text-white"
                                >
                                @error('password', 'updatePassword')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Konfirmasi Password</label>
                                <input 
                                    type="password" 
                                    id="password_confirmation" 
                                    name="password_confirmation"
                                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary dark:bg-gray-700 dark:text-white"
                                >
                                @error('password_confirmation', 'updatePassword')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <button type="submit" class="px-6 py-2 bg-primary text-white font-semibold rounded-lg hover:opacity-90 transition-opacity">
                                    Update Password
                                </button>
                                
                                @if(session('status') === 'password-updated')
                                    <span class="ml-3 text-sm text-green-600">Tersimpan.</span>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Delete Account -->
                <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-sm">
                    <h2 class="text-lg font-semibold text-red-600 mb-4">Hapus Akun</h2>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">
                        Setelah akun dihapus, semua data akan dihapus secara permanen. Pastikan untuk backup data yang diperlukan.
                    </p>
                    
                    <form method="POST" action="{{ route('profile.destroy') }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus akun?')">
                        @csrf
                        @method('DELETE')

                        <div class="max-w-xl">
                            <div class="mb-4">
                                <label for="delete_password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Konfirmasi Password</label>
                                <input 
                                    type="password" 
                                    id="delete_password" 
                                    name="password"
                                    placeholder="Masukkan password untuk konfirmasi"
                                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 dark:bg-gray-700 dark:text-white"
                                >
                                @error('password', 'userDeletion')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <button type="submit" class="px-6 py-2 bg-red-600 text-white font-semibold rounded-lg hover:bg-red-700 transition-colors">
                                Hapus Akun
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
</div>
@endsection
