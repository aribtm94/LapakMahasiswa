@extends('layouts.guest')

@section('title', 'Login - LapakMahasiswa')

@section('content')
<h2 class="text-2xl font-bold text-center text-gray-800 dark:text-white mb-6">Masuk ke Akun</h2>

@if(session('status'))
    <div class="mb-4 p-3 bg-green-100 border border-green-300 text-green-700 rounded-lg text-sm">
        {{ session('status') }}
    </div>
@endif

<form method="POST" action="{{ route('login') }}">
    @csrf

    <!-- Email -->
    <div class="mb-4">
        <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Email</label>
        <input 
            type="email" 
            id="email" 
            name="email" 
            value="{{ old('email') }}" 
            required 
            autofocus
            class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary dark:bg-gray-700 dark:text-white"
            placeholder="email@contoh.com"
        >
        @error('email')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <!-- Password -->
    <div class="mb-4">
        <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Password</label>
        <input 
            type="password" 
            id="password" 
            name="password" 
            required
            class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary dark:bg-gray-700 dark:text-white"
            placeholder="••••••••"
        >
        @error('password')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <!-- Remember Me -->
    <div class="flex items-center justify-between mb-6">
        <label class="flex items-center">
            <input type="checkbox" name="remember" class="w-4 h-4 text-primary border-gray-300 rounded focus:ring-primary">
            <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">Ingat saya</span>
        </label>
        
        @if (Route::has('password.request'))
            <a href="{{ route('password.request') }}" class="text-sm text-primary hover:underline">
                Lupa password?
            </a>
        @endif
    </div>

    <button type="submit" class="w-full py-3 px-4 bg-primary text-white font-semibold rounded-lg hover:opacity-90 transition-opacity">
        Masuk
    </button>
</form>

<p class="mt-6 text-center text-sm text-gray-600 dark:text-gray-400">
    Belum punya akun? 
    <a href="{{ route('register') }}" class="text-primary font-medium hover:underline">Daftar sekarang</a>
</p>
@endsection
