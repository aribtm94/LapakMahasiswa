@extends('layouts.app')

@section('title', 'Dashboard - LapakMahasiswa')

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
                <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 px-4 py-3 text-primary bg-primary/10 rounded-lg font-medium">
                    <span class="material-symbols-outlined">dashboard</span>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('profile.edit') }}" class="flex items-center space-x-3 px-4 py-3 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-colors">
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
                
                @if(Auth::user()->role !== 'seller')
                <div class="pt-4 border-t border-gray-200 dark:border-gray-700 mt-4">
                    <a href="{{ route('seller.register') }}" class="flex items-center space-x-3 px-4 py-3 text-green-700 bg-green-50 hover:bg-green-100 rounded-lg transition-colors">
                        <span class="material-symbols-outlined">storefront</span>
                        <span>Daftar Jadi Penjual</span>
                    </a>
                </div>
                @endif
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-8">
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white mb-6">Dashboard</h1>
            
            @if(session('status'))
                <div class="mb-6 p-4 bg-green-100 border border-green-300 text-green-700 rounded-lg">
                    {{ session('status') }}
                </div>
            @endif

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-sm">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 dark:text-gray-400 text-sm">Total Pesanan</p>
                            <p class="text-3xl font-bold text-gray-800 dark:text-white mt-1">0</p>
                        </div>
                        <div class="h-12 w-12 bg-blue-100 dark:bg-blue-900/30 rounded-full flex items-center justify-center">
                            <span class="material-symbols-outlined text-blue-600 dark:text-blue-400">shopping_cart</span>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-sm">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 dark:text-gray-400 text-sm">Wishlist</p>
                            <p class="text-3xl font-bold text-gray-800 dark:text-white mt-1">0</p>
                        </div>
                        <div class="h-12 w-12 bg-red-100 dark:bg-red-900/30 rounded-full flex items-center justify-center">
                            <span class="material-symbols-outlined text-red-600 dark:text-red-400">favorite</span>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-sm">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 dark:text-gray-400 text-sm">Review</p>
                            <p class="text-3xl font-bold text-gray-800 dark:text-white mt-1">0</p>
                        </div>
                        <div class="h-12 w-12 bg-yellow-100 dark:bg-yellow-900/30 rounded-full flex items-center justify-center">
                            <span class="material-symbols-outlined text-yellow-600 dark:text-yellow-400">star</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Welcome Card -->
            <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-sm">
                <h2 class="text-lg font-semibold text-gray-800 dark:text-white mb-2">Selamat Datang, {{ Auth::user()->name }}!</h2>
                <p class="text-gray-600 dark:text-gray-400">
                    Anda login sebagai <span class="font-medium text-primary">{{ Auth::user()->email }}</span>
                </p>
            </div>
        </main>
    </div>
</div>
@endsection
