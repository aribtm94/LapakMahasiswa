@extends('layouts.app')

@section('title', 'Tambah Produk - LapakMahasiswa')

@section('content')
<div class="min-h-screen bg-[#f6f7f8] py-10">
    <div class="max-w-3xl mx-auto bg-white rounded-2xl shadow-sm border border-[#d0e0e7] p-8">
        <h1 class="text-2xl font-bold font-display text-[#0e171b] mb-6 flex items-center">
            <span class="material-symbols-outlined text-primary mr-2">add_box</span>
            Tambah Produk Baru
        </h1>

        @if ($errors->any())
            <div class="mb-4 bg-red-50 border border-red-200 text-red-700 text-sm rounded-lg px-4 py-3">
                <div class="font-semibold mb-1">Ada beberapa error:</div>
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('seller.products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf

            <div>
                <label class="block text-sm font-medium text-[#0e171b] mb-1">Nama Produk</label>
                <input type="text" name="name" value="{{ old('name') }}" class="w-full border border-[#d0e0e7] rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary focus:border-primary" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-[#0e171b] mb-1">Deskripsi</label>
                <textarea name="description" rows="4" class="w-full border border-[#d0e0e7] rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary focus:border-primary">{{ old('description') }}</textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-[#0e171b] mb-1">Nama Toko</label>
                    <input type="text" name="shop_name" value="{{ old('shop_name', auth()->user()->shop_name) }}" class="w-full border border-[#d0e0e7] rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary focus:border-primary">
                </div>
                <div>
                    <label class="block text-sm font-medium text-[#0e171b] mb-1">Kondisi</label>
                    <select name="condition" class="w-full border border-[#d0e0e7] rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary focus:border-primary">
                        <option value="baru" {{ old('condition') === 'baru' ? 'selected' : '' }}>Baru</option>
                        <option value="bekas" {{ old('condition') === 'bekas' ? 'selected' : '' }}>Bekas</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-medium text-[#0e171b] mb-1">Harga (Rp)</label>
                    <input type="number" name="price" value="{{ old('price') }}" min="0" class="w-full border border-[#d0e0e7] rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary focus:border-primary" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-[#0e171b] mb-1">Min. Order</label>
                    <input type="number" name="min_order" value="{{ old('min_order', 1) }}" min="1" class="w-full border border-[#d0e0e7] rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary focus:border-primary">
                </div>
                <div>
                    <label class="block text-sm font-medium text-[#0e171b] mb-1">Stok</label>
                    <input type="number" name="stock" value="{{ old('stock', 0) }}" min="0" class="w-full border border-[#d0e0e7] rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary focus:border-primary">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-[#0e171b] mb-1">Etalase</label>
                    <input type="text" name="showcase" value="{{ old('showcase') }}" class="w-full border border-[#d0e0e7] rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary focus:border-primary" placeholder="Misal: MICROPHONE CABLE">
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-[#0e171b] mb-1">Foto Produk</label>
                <p class="text-xs text-[#4d8199] mb-2">Pilih lebih dari satu foto (foto pertama akan jadi foto utama). Max 2MB per foto.</p>
                <input type="file" name="photos[]" multiple accept="image/*" class="w-full border border-dashed border-[#d0e0e7] rounded-lg px-3 py-3 text-sm bg-[#f9fafb]">
            </div>

            <div class="flex justify-end space-x-3 pt-4">
                <a href="{{ url()->previous() }}" class="px-4 py-2 text-sm rounded-full border border-[#d0e0e7] text-[#0e171b] hover:bg-gray-50">Batal</a>
                <button type="submit" class="px-5 py-2 text-sm rounded-full bg-primary text-white font-semibold hover:opacity-90">Simpan Produk</button>
            </div>
        </form>
    </div>
</div>
@endsection
