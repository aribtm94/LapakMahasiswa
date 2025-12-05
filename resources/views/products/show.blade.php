<!DOCTYPE html>
<html class="light" lang="id">
<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $product->name }} - LapakMahasiswa</title>
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
<body class="font-display antialiased bg-background-light text-[#0e171b]">
<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header sederhana Lapak Mahasiswa -->
    <header class="mb-6">
        <div class="flex items-center justify-between">
            <a href="{{ url('/') }}" class="flex items-center space-x-3 group">
                <span class="material-symbols-outlined text-primary text-4xl group-hover:scale-105 transition-transform">store</span>
                <div>
                    <h1 class="text-2xl font-bold text-primary group-hover:underline">Lapak Mahasiswa</h1>
                    <p class="text-xs text-slate-500">Marketplace khusus civitas kampus</p>
                </div>
            </a>
        </div>
    </header>

    <!-- Breadcrumb -->
    <nav class="text-sm text-slate-500 mb-6" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1">
            <li class="flex items-center">
                <a href="{{ url('/') }}" class="hover:text-primary">Beranda</a>
                <span class="material-symbols-outlined mx-1 text-base text-slate-400">chevron_right</span>
            </li>
            @if($product->showcase)
                <li class="flex items-center">
                    <span class="hover:text-primary">{{ $product->showcase }}</span>
                    <span class="material-symbols-outlined mx-1 text-base text-slate-400">chevron_right</span>
                </li>
            @endif
            <li class="flex items-center text-slate-700 font-medium">
                {{ \Illuminate\Support\Str::limit($product->name, 30) }}
            </li>
        </ol>
    </nav>

    <main class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Kiri: gambar + info produk -->
        <div class="lg:col-span-2">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="md:col-span-1">
                    <!-- Foto utama -->
                    @php
                        $mainPhoto = $product->photos->first();
                    @endphp
                    <div class="relative w-full aspect-square bg-slate-100 rounded-lg border border-slate-200 overflow-hidden">
                        <img
                            id="main-product-image"
                            src="{{ $mainPhoto ? asset('storage/'.$mainPhoto->path) : 'https://via.placeholder.com/400x400?text=Produk' }}"
                            alt="{{ $product->name }}"
                            class="w-full h-full object-contain max-w-full max-h-full"
                        />
                    </div>
                    <!-- Thumbnail -->
                    <div class="grid grid-cols-4 gap-2 mt-4">
                        @foreach($product->photos as $photo)
                            <div class="relative aspect-square bg-slate-100 rounded-md border border-slate-200 overflow-hidden cursor-pointer hover:ring-2 hover:ring-primary">
                                <img
                                    src="{{ asset('storage/'.$photo->path) }}"
                                    data-full-url="{{ asset('storage/'.$photo->path) }}"
                                    alt="Foto {{ $product->name }}"
                                    class="w-full h-full object-cover"
                                    onclick="document.getElementById('main-product-image').src = this.dataset.fullUrl;"
                                />
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="md:col-span-2">
                    <h1 class="text-2xl font-bold text-slate-900">
                        {{ $product->name }}
                    </h1>

                    <div class="flex items-center space-x-2 mt-2 text-sm text-slate-500">
                        @if($product->sold_count)
                            <span>Terjual {{ $product->sold_count }}</span>
                            <span class="text-slate-300">|</span>
                        @endif
                        <div class="flex items-center">
                            <span class="material-symbols-outlined text-yellow-400 text-base">star</span>
                            <span class="ml-1 font-medium text-slate-800">
                                {{ number_format($averageRating, 1) }}
                            </span>
                            <span class="ml-1">({{ $reviewsCount }} rating)</span>
                        </div>
                    </div>

                    <p class="text-4xl font-bold text-slate-900 mt-4">
                        Rp{{ number_format($product->price, 0, ',', '.') }}
                    </p>

                    <div class="border-t border-slate-200 my-6"></div>

                    <div class="space-y-2 text-sm">
                        <p>
                            <span class="font-medium text-slate-600 w-24 inline-block">Kondisi:</span>
                            <span class="text-slate-800">{{ ucfirst($product->condition ?? 'Tidak diketahui') }}</span>
                        </p>
                        <p>
                            <span class="font-medium text-slate-600 w-24 inline-block">Min. Order:</span>
                            <span class="text-slate-800">{{ $product->min_order ?? 1 }} pcs</span>
                        </p>
                        <p>
                            <span class="font-medium text-slate-600 w-24 inline-block">Etalase:</span>
                            <span class="text-primary font-medium">
                                {{ $product->showcase ?? '-' }}
                            </span>
                        </p>
                        <p>
                            <span class="font-medium text-slate-600 w-24 inline-block">Toko:</span>
                            @php
                                $seller = $product->seller;
                                $shopLabel = $product->shop_name ?? optional($seller)->shop_name ?? 'Lapak Mahasiswa';
                            @endphp
                            @if($seller)
                                <a href="{{ route('shops.show', $seller) }}" class="text-primary font-medium hover:underline">
                                    {{ $shopLabel }}
                                </a>
                            @else
                                <span class="text-slate-800">{{ $shopLabel }}</span>
                            @endif
                        </p>
                    </div>
                </div>
            </div>

            <!-- Tab detail & review (simplified fokus review) -->
            <div class="mt-10 border-t border-slate-200">
                <div class="border-b border-slate-200">
                    <nav class="-mb-px flex space-x-8 text-sm">
                        <a href="#detail"
                           class="py-4 px-1 border-b-2 border-primary text-primary font-medium">
                            Detail Produk
                        </a>
                        <a href="#review"
                           class="py-4 px-1 border-b-2 border-transparent text-slate-500 hover:text-primary hover:border-primary">
                            Ulasan
                        </a>
                    </nav>
                </div>

                <div id="detail" class="py-6 prose max-w-none text-sm text-slate-800">
                    {!! nl2br(e($product->description)) !!}
                </div>

                <div id="review" class="py-6">
                    <h3 class="text-lg font-semibold text-slate-900 mb-4">Ulasan Pembeli</h3>

                    <!-- Ringkasan rating -->
                    <div class="flex flex-col md:flex-row md:items-start md:space-x-6 mb-6">
                        <div class="text-center mb-4 md:mb-0">
                            <div class="flex items-center justify-center text-4xl font-bold text-slate-900">
                                <span class="material-symbols-outlined text-yellow-400 text-3xl mr-1">star</span>
                                {{ number_format($averageRating, 1) }}
                                <span class="text-base font-normal text-slate-500 ml-2">/5.0</span>
                            </div>
                            <p class="text-xs text-slate-500 mt-1">
                                {{ $reviewsCount }} rating
                            </p>
                        </div>
                        <div class="flex-grow">
                            @for($i = 5; $i >= 1; $i--)
                                @php
                                    $count = $ratingCounts[$i] ?? 0;
                                    $percent = $reviewsCount > 0 ? ($count / max($reviewsCount,1)) * 100 : 0;
                                @endphp
                                <div class="flex items-center text-xs mb-1">
                                    <div class="flex items-center text-yellow-400 w-10">
                                        <span class="material-symbols-outlined text-sm">star</span>
                                        <span class="ml-1">{{ $i }}</span>
                                    </div>
                                    <div class="w-full bg-slate-200 rounded-full h-1.5 mx-2">
                                        <div class="bg-primary h-1.5 rounded-full" style="width: {{ $percent }}%"></div>
                                    </div>
                                    <span class="text-slate-500">({{ $count }})</span>
                                </div>
                            @endfor
                        </div>
                    </div>

                    <!-- Notifikasi sukses -->
                    @if(session('status'))
                        <div class="mb-4 text-sm text-green-700 bg-green-50 border border-green-200 px-3 py-2 rounded">
                            {{ session('status') }}
                        </div>
                    @endif

                    <!-- Form ulasan tamu -->
                    <div class="mb-8 border border-slate-200 rounded-lg p-4 bg-slate-50">
                        <h4 class="font-semibold text-slate-900 mb-2">Tulis Ulasanmu</h4>
                        <p class="text-xs text-slate-500 mb-3">
                            Tidak perlu login, cukup isi nama dan email.
                        </p>
                        <form method="POST" action="{{ route('products.reviews.store', $product) }}" class="space-y-3">
                            @csrf
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                <div>
                                    <label class="block text-xs font-medium text-slate-700">Nama</label>
                                    <input name="name" value="{{ old('name') }}"
                                           class="mt-1 block w-full border border-slate-300 rounded-md px-3 py-2 text-sm">
                                    @error('name')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-slate-700">Email</label>
                                    <input type="email" name="email" value="{{ old('email') }}"
                                           class="mt-1 block w-full border border-slate-300 rounded-md px-3 py-2 text-sm">
                                    @error('email')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                <div>
                                    <label class="block text-xs font-medium text-slate-700">Provinsi <span class="text-slate-400">(opsional)</span></label>
                                    <select name="provinsi" id="provinsi-review"
                                            class="mt-1 block w-full border border-slate-300 rounded-md px-2 py-2 text-sm">
                                        <option value="">-- Pilih Provinsi --</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-slate-700">Rating</label>
                                    <select name="rating"
                                            class="mt-1 block w-full border border-slate-300 rounded-md px-2 py-2 text-sm">
                                        @for($i = 5; $i >= 1; $i--)
                                            <option value="{{ $i }}" {{ old('rating') == $i ? 'selected' : '' }}>
                                                {{ $i }} Bintang
                                            </option>
                                        @endfor
                                    </select>
                                    @error('rating')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
                                </div>
                            </div>

                            <div>
                                <label class="block text-xs font-medium text-slate-700">Komentar</label>
                                <textarea name="comment" rows="3"
                                          class="mt-1 block w-full border border-slate-300 rounded-md px-3 py-2 text-sm">{{ old('comment') }}</textarea>
                                @error('comment')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
                            </div>

                            <button type="submit"
                                    class="inline-flex items-center px-4 py-2 bg-primary text-white text-sm font-semibold rounded-md hover:bg-blue-700">
                                Kirim Ulasan
                            </button>
                        </form>
                    </div>

                    <!-- Daftar ulasan -->
                    <div class="space-y-4">
                        @forelse($product->guestReviews()->latest()->get() as $review)
                            <div class="border-b border-slate-200 pb-4">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="font-semibold text-slate-900">{{ $review->name }}</p>
                                        <div class="flex items-center text-xs text-slate-500 mt-1">
                                            <div class="flex text-yellow-400">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <span class="material-symbols-outlined text-sm">
                                                        {{ $i <= $review->rating ? 'star' : 'star_border' }}
                                                    </span>
                                                @endfor
                                            </div>
                                            <span class="ml-2">
                                                {{ $review->created_at?->diffForHumans() }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <p class="mt-3 text-sm text-slate-700">
                                    {{ $review->comment }}
                                </p>
                            </div>
                        @empty
                            <p class="text-sm text-slate-500">Belum ada ulasan. Jadilah yang pertama memberi review.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        <!-- Kanan: informasi harga singkat -->
        <aside class="lg:col-span-1">
            <div class="sticky top-8 border border-slate-200 rounded-lg p-6 bg-white shadow-sm">
                <h2 class="text-lg font-semibold text-slate-900 mb-4">
                    Informasi Harga
                </h2>
                <div class="flex justify-between items-center mb-2">
                    <span class="text-slate-500 text-sm">Harga</span>
                    <span class="text-xl font-bold text-slate-900">
                        Rp{{ number_format($product->price, 0, ',', '.') }}
                    </span>
                </div>
                <div class="mt-2 text-xs text-slate-500">
                    Stok: <span class="font-semibold text-slate-700">{{ $product->stock ?? '-' }}</span>
                </div>
            </div>
        </aside>
    </main>
</div>

<script>
// Load provinsi untuk form review
document.addEventListener('DOMContentLoaded', function() {
    const provinsiSelect = document.getElementById('provinsi-review');
    if (provinsiSelect) {
        fetch('/api/region/provinces')
            .then(response => response.json())
            .then(provinces => {
                provinces.forEach(prov => {
                    const option = document.createElement('option');
                    option.value = prov.name;
                    option.textContent = prov.name;
                    provinsiSelect.appendChild(option);
                });
            })
            .catch(error => console.error('Error loading provinces:', error));
    }
});
</script>
</body>
</html>
