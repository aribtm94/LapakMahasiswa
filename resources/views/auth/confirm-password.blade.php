@extends('layouts.guest')

@section('title', 'Konfirmasi Password - LapakMahasiswa')

@section('content')
<h2 class="text-2xl font-bold text-center text-gray-800 dark:text-white mb-4">Konfirmasi Password</h2>
<p class="text-sm text-gray-600 dark:text-gray-400 text-center mb-6">
    Ini adalah area yang aman. Silakan konfirmasi password Anda sebelum melanjutkan.
</p>

<form method="POST" action="{{ route('password.confirm') }}">
    @csrf

    <!-- Password -->
    <div class="mb-6">
        <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Password</label>
        <input 
            type="password" 
            id="password" 
            name="password" 
            required 
            autofocus
            class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary dark:bg-gray-700 dark:text-white"
            placeholder="••••••••"
        >
        @error('password')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <button type="submit" class="w-full py-3 px-4 bg-primary text-white font-semibold rounded-lg hover:opacity-90 transition-opacity">
        Konfirmasi
    </button>
</form>
@endsection
