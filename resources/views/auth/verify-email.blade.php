@extends('layouts.guest')

@section('title', 'Verifikasi Email - LapakMahasiswa')

@section('content')
<div class="text-center">
    <div class="flex justify-center mb-4">
        <div class="h-16 w-16 bg-primary/10 rounded-full flex items-center justify-center">
            <span class="material-symbols-outlined text-primary text-3xl">mail</span>
        </div>
    </div>
    
    <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-4">Verifikasi Email Anda</h2>
    <p class="text-sm text-gray-600 dark:text-gray-400 mb-6">
        Terima kasih telah mendaftar! Sebelum memulai, silakan verifikasi email Anda dengan mengklik link yang telah kami kirim.
    </p>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 p-3 bg-green-100 border border-green-300 text-green-700 rounded-lg text-sm">
            Link verifikasi baru telah dikirim ke email Anda.
        </div>
    @endif
</div>

<div class="flex flex-col gap-4">
    <form method="POST" action="{{ route('verification.send') }}">
        @csrf
        <button type="submit" class="w-full py-3 px-4 bg-primary text-white font-semibold rounded-lg hover:opacity-90 transition-opacity">
            Kirim Ulang Email Verifikasi
        </button>
    </form>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="w-full py-3 px-4 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 font-semibold rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
            Logout
        </button>
    </form>
</div>
@endsection
