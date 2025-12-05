@extends('layouts.seller')

@section('title', 'Pengaturan Toko - LapakMahasiswa')
@section('page-title', 'Pengaturan')

@section('content')
<div class="space-y-6">
    <!-- Page Header -->
    <div>
        <h1 class="text-2xl lg:text-3xl font-bold font-display text-[#0e171b]">Pengaturan Toko</h1>
        <p class="text-[#4d8199] mt-1">Kelola informasi toko, kontak, dan password Anda</p>
    </div>
    
    @if(session('status'))
        <div class="p-4 bg-green-100 border border-green-300 text-green-700 rounded-xl flex items-center gap-3">
            <span class="material-symbols-outlined">check_circle</span>
            {{ session('status') }}
        </div>
    @endif

    @if(session('error'))
        <div class="p-4 bg-red-100 border border-red-300 text-red-700 rounded-xl flex items-center gap-3">
            <span class="material-symbols-outlined">error</span>
            {{ session('error') }}
        </div>
    @endif

    @if(session('info'))
        <div class="p-4 bg-blue-100 border border-blue-300 text-blue-700 rounded-xl flex items-center gap-3">
            <span class="material-symbols-outlined">info</span>
            {{ session('info') }}
        </div>
    @endif

    <div class="space-y-6">
        <!-- Shop Information -->
        <div class="bg-white rounded-2xl border border-[#d0e0e7] overflow-hidden">
            <div class="px-6 py-4 border-b border-[#d0e0e7] bg-[#f6f7f8]">
                <h2 class="text-lg font-bold font-display text-[#0e171b] flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary">storefront</span>
                    Informasi Toko
                </h2>
                <p class="text-sm text-[#4d8199] mt-1">Perubahan pada informasi toko memerlukan persetujuan admin</p>
            </div>
            
            @if($pendingUpdate)
                <div class="px-6 py-4 bg-yellow-50 border-b border-yellow-200">
                    <div class="flex items-start gap-3">
                        <span class="material-symbols-outlined text-yellow-600">pending</span>
                        <div class="flex-1">
                            <p class="text-sm font-medium text-yellow-800">Permintaan Perubahan Menunggu Persetujuan</p>
                            <p class="text-sm text-yellow-700 mt-1">
                                <strong>Nama Toko Baru:</strong> {{ $pendingUpdate->shop_name }}<br>
                                <strong>Deskripsi Baru:</strong> {{ $pendingUpdate->shop_description ?: '-' }}
                            </p>
                            <form method="POST" action="{{ route('seller.settings.cancel-update') }}" class="mt-3">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-sm text-red-600 hover:text-red-800 font-medium">
                                    Batalkan Permintaan
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endif

            <form method="POST" action="{{ route('seller.settings.update-shop') }}" class="p-6 space-y-4">
                @csrf
                @method('PUT')
                
                <div>
                    <label for="shop_name" class="block text-sm font-medium text-[#0e171b] mb-1">
                        Nama Toko <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="text" 
                        id="shop_name" 
                        name="shop_name" 
                        value="{{ old('shop_name', $user->shop_name) }}"
                        class="w-full px-4 py-2 border border-[#d0e0e7] rounded-xl focus:ring-2 focus:ring-primary focus:border-primary"
                        {{ $pendingUpdate ? 'disabled' : '' }}
                    >
                    @error('shop_name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="shop_description" class="block text-sm font-medium text-[#0e171b] mb-1">
                        Deskripsi Toko
                    </label>
                    <textarea 
                        id="shop_description" 
                        name="shop_description" 
                        rows="3"
                        class="w-full px-4 py-2 border border-[#d0e0e7] rounded-xl focus:ring-2 focus:ring-primary focus:border-primary resize-none"
                        {{ $pendingUpdate ? 'disabled' : '' }}
                    >{{ old('shop_description', $user->shop_description) }}</textarea>
                    @error('shop_description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center gap-2 pt-2">
                    <button 
                        type="submit" 
                        class="px-5 py-2.5 bg-primary text-white font-semibold rounded-xl hover:opacity-90 transition-opacity disabled:opacity-50 disabled:cursor-not-allowed"
                        {{ $pendingUpdate ? 'disabled' : '' }}
                    >
                        Ajukan Perubahan
                    </button>
                    <span class="text-xs text-[#4d8199]">
                        <span class="material-symbols-outlined text-sm align-middle">info</span>
                        Memerlukan persetujuan admin
                    </span>
                </div>
            </form>
        </div>

        <!-- Contact Information -->
        <div class="bg-white rounded-2xl border border-[#d0e0e7] overflow-hidden">
            <div class="px-6 py-4 border-b border-[#d0e0e7] bg-[#f6f7f8]">
                <h2 class="text-lg font-bold font-display text-[#0e171b] flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary">contact_mail</span>
                    Informasi Kontak
                </h2>
                <p class="text-sm text-[#4d8199] mt-1">Masukkan password untuk mengubah informasi kontak</p>
            </div>
            <form method="POST" action="{{ route('seller.settings.update-contact') }}" class="p-6 space-y-4">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="pic_email" class="block text-sm font-medium text-[#0e171b] mb-1">
                            Email <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="email" 
                            id="pic_email" 
                            name="pic_email" 
                            value="{{ old('pic_email', $user->pic_email) }}"
                            autocomplete="off"
                            class="w-full px-4 py-2 border border-[#d0e0e7] rounded-xl focus:ring-2 focus:ring-primary focus:border-primary"
                        >
                        @error('pic_email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="pic_phone" class="block text-sm font-medium text-[#0e171b] mb-1">
                            Nomor Telepon <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="text" 
                            id="pic_phone" 
                            name="pic_phone" 
                            value="{{ old('pic_phone', $user->pic_phone) }}"
                            placeholder="08xxxxxxxxxx"
                            class="w-full px-4 py-2 border border-[#d0e0e7] rounded-xl focus:ring-2 focus:ring-primary focus:border-primary"
                        >
                        @error('pic_phone')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="current_password_contact" class="block text-sm font-medium text-[#0e171b] mb-1">
                        Password Saat Ini <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input 
                            type="password" 
                            id="current_password_contact" 
                            name="current_password_contact"
                            autocomplete="new-password"
                            class="w-full px-4 py-2 pr-12 border border-[#d0e0e7] rounded-xl focus:ring-2 focus:ring-primary focus:border-primary"
                            placeholder="Masukkan password untuk konfirmasi"
                        >
                        <button type="button" onclick="togglePasswordVisibility('current_password_contact', 'toggle-icon-contact')" class="absolute inset-y-0 right-0 flex items-center px-3 text-[#4d8199] hover:text-[#0e171b]">
                            <span class="material-symbols-outlined text-xl" id="toggle-icon-contact">visibility_off</span>
                        </button>
                    </div>
                    @error('current_password_contact')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="px-5 py-2.5 bg-primary text-white font-semibold rounded-xl hover:opacity-90 transition-opacity">
                    Simpan Perubahan Kontak
                </button>
            </form>
        </div>

        <!-- Change Password -->
        <div class="bg-white rounded-2xl border border-[#d0e0e7] overflow-hidden">
            <div class="px-6 py-4 border-b border-[#d0e0e7] bg-[#f6f7f8]">
                <h2 class="text-lg font-bold font-display text-[#0e171b] flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary">lock</span>
                    Ubah Password
                </h2>
                <p class="text-sm text-[#4d8199] mt-1">Pastikan password baru memenuhi semua persyaratan</p>
            </div>
            <form method="POST" action="{{ route('seller.settings.update-password') }}" class="p-6 space-y-4" id="password-form">
                @csrf
                @method('PUT')
                
                <div>
                    <label for="current_password" class="block text-sm font-medium text-[#0e171b] mb-1">
                        Password Saat Ini <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input 
                            type="password" 
                            id="current_password" 
                            name="current_password"
                            autocomplete="new-password"
                            class="w-full px-4 py-2 pr-12 border border-[#d0e0e7] rounded-xl focus:ring-2 focus:ring-primary focus:border-primary"
                            placeholder="Masukkan password saat ini"
                        >
                        <button type="button" onclick="togglePasswordVisibility('current_password', 'toggle-icon-current')" class="absolute inset-y-0 right-0 flex items-center px-3 text-[#4d8199] hover:text-[#0e171b]">
                            <span class="material-symbols-outlined text-xl" id="toggle-icon-current">visibility_off</span>
                        </button>
                    </div>
                    @error('current_password')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="password" class="block text-sm font-medium text-[#0e171b] mb-1">
                            Password Baru <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <input 
                                type="password" 
                                id="password" 
                                name="password"
                                autocomplete="new-password"
                                class="w-full px-4 py-2 pr-12 border border-[#d0e0e7] rounded-xl focus:ring-2 focus:ring-primary focus:border-primary"
                                placeholder="Masukkan password baru"
                            >
                            <button type="button" onclick="togglePasswordVisibility('password', 'toggle-icon-new')" class="absolute inset-y-0 right-0 flex items-center px-3 text-[#4d8199] hover:text-[#0e171b]">
                                <span class="material-symbols-outlined text-xl" id="toggle-icon-new">visibility_off</span>
                            </button>
                        </div>
                        @error('password')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-[#0e171b] mb-1">
                            Konfirmasi Password Baru <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <input 
                                type="password" 
                                id="password_confirmation" 
                                name="password_confirmation"
                                autocomplete="new-password"
                                class="w-full px-4 py-2 pr-12 border border-[#d0e0e7] rounded-xl focus:ring-2 focus:ring-primary focus:border-primary"
                                placeholder="Konfirmasi password baru"
                            >
                            <button type="button" onclick="togglePasswordVisibility('password_confirmation', 'toggle-icon-confirm')" class="absolute inset-y-0 right-0 flex items-center px-3 text-[#4d8199] hover:text-[#0e171b]">
                                <span class="material-symbols-outlined text-xl" id="toggle-icon-confirm">visibility_off</span>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Password Requirements -->
                <div class="p-4 bg-[#f6f7f8] rounded-xl border border-[#d0e0e7]">
                    <p class="text-sm font-medium text-[#0e171b] mb-3">Persyaratan Password:</p>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                        <div class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-lg text-red-500" id="icon-lowercase">close</span>
                            <span class="text-sm text-[#4d8199]">Minimal 1 huruf kecil (a-z)</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-lg text-red-500" id="icon-uppercase">close</span>
                            <span class="text-sm text-[#4d8199]">Minimal 1 huruf besar (A-Z)</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-lg text-red-500" id="icon-number">close</span>
                            <span class="text-sm text-[#4d8199]">Minimal 1 angka (0-9)</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-lg text-red-500" id="icon-symbol">close</span>
                            <span class="text-sm text-[#4d8199]">Minimal 1 simbol (!@#$%^&*)</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-lg text-red-500" id="icon-length">close</span>
                            <span class="text-sm text-[#4d8199]">Minimal 8 karakter</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-lg text-red-500" id="icon-match">close</span>
                            <span class="text-sm text-[#4d8199]">Password cocok</span>
                        </div>
                    </div>
                </div>

                <button type="submit" id="submit-password-btn" disabled class="px-5 py-2.5 bg-primary text-white font-semibold rounded-xl hover:opacity-90 transition-opacity disabled:opacity-50 disabled:cursor-not-allowed">
                    Ubah Password
                </button>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Toggle password visibility
    function togglePasswordVisibility(inputId, iconId) {
        const input = document.getElementById(inputId);
        const icon = document.getElementById(iconId);
        
        if (input.type === 'password') {
            input.type = 'text';
            icon.textContent = 'visibility';
        } else {
            input.type = 'password';
            icon.textContent = 'visibility_off';
        }
    }

    // Password validation
    const passwordInput = document.getElementById('password');
    const confirmInput = document.getElementById('password_confirmation');
    const submitBtn = document.getElementById('submit-password-btn');

    function updateRequirement(iconId, isValid) {
        const icon = document.getElementById(iconId);
        if (isValid) {
            icon.textContent = 'check';
            icon.classList.remove('text-red-500');
            icon.classList.add('text-green-500');
        } else {
            icon.textContent = 'close';
            icon.classList.remove('text-green-500');
            icon.classList.add('text-red-500');
        }
    }

    function validatePassword() {
        const password = passwordInput.value;
        const confirm = confirmInput.value;

        const hasLowercase = /[a-z]/.test(password);
        updateRequirement('icon-lowercase', hasLowercase);

        const hasUppercase = /[A-Z]/.test(password);
        updateRequirement('icon-uppercase', hasUppercase);

        const hasNumber = /[0-9]/.test(password);
        updateRequirement('icon-number', hasNumber);

        const hasSymbol = /[@$!%*#?&^]/.test(password);
        updateRequirement('icon-symbol', hasSymbol);

        const hasLength = password.length >= 8;
        updateRequirement('icon-length', hasLength);

        const isMatch = password === confirm && password.length > 0;
        updateRequirement('icon-match', isMatch);

        const allValid = hasLowercase && hasUppercase && hasNumber && hasSymbol && hasLength && isMatch;
        submitBtn.disabled = !allValid;

        return allValid;
    }

    passwordInput.addEventListener('input', validatePassword);
    confirmInput.addEventListener('input', validatePassword);
</script>
@endpush
