@extends('layouts.app')

@section('title', 'Admin - Verifikasi Penjual')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Header -->
    <header class="flex items-center justify-between py-6">
        <a href="{{ url('/') }}" class="text-3xl font-bold font-display text-[#0e171b] dark:text-white">
            LapakMahasiswa
        </a>
        
        <div class="flex items-center space-x-4">
            <span class="text-sm text-[#4d8199]">Admin Panel</span>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="px-4 py-2 border border-red-500 text-red-500 rounded-full font-semibold hover:bg-red-500 hover:text-white transition-colors text-sm">
                    <span class="material-symbols-outlined text-lg align-middle mr-1">logout</span>
                    Keluar
                </button>
            </form>
        </div>
    </header>

    <!-- Main Content -->
    <main class="mt-4 pb-12">
        <!-- Page Title -->
        <div class="bg-primary rounded-2xl p-8 mb-8">
            <h1 class="text-3xl font-black font-display text-white">Dashboard Verifikasi Penjual</h1>
            <p class="text-white/80 mt-2">Kelola persetujuan pendaftaran seller di sini</p>
        </div>

        @if(session('status'))
            <div class="mb-6 p-4 bg-green-100 dark:bg-green-900/30 border border-green-300 dark:border-green-700 text-green-700 dark:text-green-400 rounded-lg">
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined">check_circle</span>
                    <span>{{ session('status') }}</span>
                </div>
            </div>
        @endif

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800 rounded-2xl p-6">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-yellow-500 rounded-full flex items-center justify-center">
                        <span class="material-symbols-outlined text-white">hourglass_empty</span>
                    </div>
                    <div>
                        <p class="text-2xl font-bold text-yellow-700 dark:text-yellow-400">{{ $pending->count() }}</p>
                        <p class="text-sm text-yellow-600 dark:text-yellow-500">Menunggu Verifikasi</p>
                    </div>
                </div>
            </div>
            <div class="bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-2xl p-6">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-green-500 rounded-full flex items-center justify-center">
                        <span class="material-symbols-outlined text-white">check_circle</span>
                    </div>
                    <div>
                        <p class="text-2xl font-bold text-green-700 dark:text-green-400">{{ $approved->count() }}</p>
                        <p class="text-sm text-green-600 dark:text-green-500">Disetujui</p>
                    </div>
                </div>
            </div>
            <div class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-2xl p-6">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-red-500 rounded-full flex items-center justify-center">
                        <span class="material-symbols-outlined text-white">cancel</span>
                    </div>
                    <div>
                        <p class="text-2xl font-bold text-red-700 dark:text-red-400">{{ $rejected->count() }}</p>
                        <p class="text-sm text-red-600 dark:text-red-500">Ditolak</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Section -->
        <section class="border border-[#d0e0e7] dark:border-gray-700 rounded-2xl p-6 mb-8">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-10 h-10 bg-yellow-500 rounded-full flex items-center justify-center">
                    <span class="material-symbols-outlined text-white">hourglass_empty</span>
                </div>
                <h2 class="text-xl font-bold font-display text-[#0e171b] dark:text-white">Menunggu Verifikasi</h2>
            </div>
            
            @if($pending->count() > 0)
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b border-[#d0e0e7] dark:border-gray-700">
                                <th class="text-left py-3 px-4 font-semibold text-[#0e171b] dark:text-white">Nama Toko</th>
                                <th class="text-left py-3 px-4 font-semibold text-[#0e171b] dark:text-white">Penanggung Jawab</th>
                                <th class="text-left py-3 px-4 font-semibold text-[#0e171b] dark:text-white">Email</th>
                                <th class="text-center py-3 px-4 font-semibold text-[#0e171b] dark:text-white">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pending as $u)
                            <tr class="border-b border-[#d0e0e7] dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-800/50">
                                <td class="py-4 px-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 bg-primary/10 rounded-full flex items-center justify-center">
                                            <span class="material-symbols-outlined text-primary">store</span>
                                        </div>
                                        <span class="font-medium text-[#0e171b] dark:text-white">{{ $u->shop_name }}</span>
                                    </div>
                                </td>
                                <td class="py-4 px-4 text-[#4d8199]">{{ $u->pic_name }}</td>
                                <td class="py-4 px-4 text-[#4d8199]">{{ $u->pic_email }}</td>
                                <td class="py-4 px-4 text-center">
                                    <a href="{{ route('admin.sellers.show', $u) }}" class="inline-flex items-center gap-2 px-4 py-2 bg-primary text-white rounded-full font-semibold text-sm hover:opacity-90 transition-opacity">
                                        <span class="material-symbols-outlined text-lg">visibility</span>
                                        Lihat Detail
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-8 text-[#4d8199]">
                    <span class="material-symbols-outlined text-5xl mb-2">inbox</span>
                    <p>Tidak ada pendaftaran yang menunggu verifikasi</p>
                </div>
            @endif
        </section>

        <!-- Approved Section -->
        <section class="border border-[#d0e0e7] dark:border-gray-700 rounded-2xl p-6 mb-8">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center">
                    <span class="material-symbols-outlined text-white">check_circle</span>
                </div>
                <h2 class="text-xl font-bold font-display text-[#0e171b] dark:text-white">Disetujui</h2>
            </div>
            
            @if($approved->count() > 0)
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b border-[#d0e0e7] dark:border-gray-700">
                                <th class="text-left py-3 px-4 font-semibold text-[#0e171b] dark:text-white">Nama Toko</th>
                                <th class="text-left py-3 px-4 font-semibold text-[#0e171b] dark:text-white">Penanggung Jawab</th>
                                <th class="text-left py-3 px-4 font-semibold text-[#0e171b] dark:text-white">Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($approved as $u)
                            <tr class="border-b border-[#d0e0e7] dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-800/50">
                                <td class="py-4 px-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 bg-green-100 dark:bg-green-900/30 rounded-full flex items-center justify-center">
                                            <span class="material-symbols-outlined text-green-600">verified</span>
                                        </div>
                                        <span class="font-medium text-[#0e171b] dark:text-white">{{ $u->shop_name }}</span>
                                    </div>
                                </td>
                                <td class="py-4 px-4 text-[#4d8199]">{{ $u->pic_name }}</td>
                                <td class="py-4 px-4 text-[#4d8199]">{{ $u->pic_email }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-8 text-[#4d8199]">
                    <span class="material-symbols-outlined text-5xl mb-2">inbox</span>
                    <p>Belum ada penjual yang disetujui</p>
                </div>
            @endif
        </section>

        <!-- Rejected Section -->
        <section class="border border-[#d0e0e7] dark:border-gray-700 rounded-2xl p-6">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-10 h-10 bg-red-500 rounded-full flex items-center justify-center">
                    <span class="material-symbols-outlined text-white">cancel</span>
                </div>
                <h2 class="text-xl font-bold font-display text-[#0e171b] dark:text-white">Ditolak</h2>
            </div>
            
            @if($rejected->count() > 0)
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b border-[#d0e0e7] dark:border-gray-700">
                                <th class="text-left py-3 px-4 font-semibold text-[#0e171b] dark:text-white">Nama Toko</th>
                                <th class="text-left py-3 px-4 font-semibold text-[#0e171b] dark:text-white">Penanggung Jawab</th>
                                <th class="text-left py-3 px-4 font-semibold text-[#0e171b] dark:text-white">Alasan Penolakan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($rejected as $u)
                            <tr class="border-b border-[#d0e0e7] dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-800/50">
                                <td class="py-4 px-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 bg-red-100 dark:bg-red-900/30 rounded-full flex items-center justify-center">
                                            <span class="material-symbols-outlined text-red-600">block</span>
                                        </div>
                                        <span class="font-medium text-[#0e171b] dark:text-white">{{ $u->shop_name }}</span>
                                    </div>
                                </td>
                                <td class="py-4 px-4 text-[#4d8199]">{{ $u->pic_name }}</td>
                                <td class="py-4 px-4 text-red-600 dark:text-red-400">{{ $u->rejection_reason }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-8 text-[#4d8199]">
                    <span class="material-symbols-outlined text-5xl mb-2">inbox</span>
                    <p>Tidak ada penjual yang ditolak</p>
                </div>
            @endif
        </section>
    </main>

    <!-- Footer -->
    <footer class="py-8 border-t border-[#d0e0e7] dark:border-gray-700">
        <div class="text-center text-[#4d8199] text-sm">
            &copy; {{ date('Y') }} LapakMahasiswa. All rights reserved.
        </div>
    </footer>
</div>
@endsection
