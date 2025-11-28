@extends('layouts.app')

@section('title', $seller->shop_name . ' - Katalog Toko')

@section('content')
<div class="min-h-screen bg-[#f6f7f8] py-10">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header toko -->
        <div class="bg-white rounded-2xl shadow-sm border border-[#d0e0e7] p-6 mb-8 flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <div class="h-14 w-14 rounded-full bg-primary flex items-center justify-center text-white text-2xl font-bold">
                    {{ strtoupper(substr($seller->shop_name ?? $seller->name, 0, 1)) }}
                </div>
                <div>
                    <h1 class="text-xl font-bold font-display text-[#0e171b]">
                        {{ $seller->shop_name ?? $seller->name }}
                    </h1>
                    <p class="text-sm text-[#4d8199]">
                        Katalog produk milik {{ $seller->name }}
                    </p>
                </div>
            </div>
            <a href="{{ url('/') }}" class="text-sm text-primary hover:underline">Kembali ke beranda</a>
        </div>

        <!-- Daftar produk toko -->
        @if($products->isEmpty())
            <div class="bg-white rounded-2xl shadow-sm border border-[#d0e0e7] p-8 text-center text-[#4d8199]">
                Toko ini belum memiliki produk dalam katalog.
            </div>
        @else
            <div class="bg-white rounded-2xl shadow-sm border border-[#d0e0e7] p-6">
                <h2 class="text-lg font-semibold font-display text-[#0e171b] mb-4">Produk di Etalase</h2>
                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-6">
                    @foreach($products as $product)
                        <a href="{{ route('products.show', $product) }}" class="group border border-[#d0e0e7] rounded-2xl overflow-hidden bg-white hover:shadow-lg transition-shadow flex flex-col">
                            @php
                                $photo = optional($product->photos->first())->path;
                            @endphp
                            <div class="relative w-full aspect-square bg-[#e8eef3] flex items-center justify-center">
                                @if($photo)
                                    <img src="{{ asset('storage/'.$photo) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                                @else
                                    <span class="material-symbols-outlined text-5xl text-gray-300">image</span>
                                @endif
                            </div>
                            <div class="p-3 flex flex-col flex-1">
                                <h3 class="font-semibold text-xs md:text-sm text-[#0e171b] line-clamp-2 min-h-[2.5rem]">
                                    {{ $product->name }}
                                </h3>
                                <div class="mt-1 text-primary font-bold text-sm">
                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                </div>
                                <div class="mt-1 text-[11px] text-[#4d8199]">
                                    Etalase: {{ $product->showcase ?? '-' }}
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
