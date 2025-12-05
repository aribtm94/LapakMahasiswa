@extends('layouts.seller')

@section('title', 'Dashboard Penjual - LapakMahasiswa')
@section('page-title', 'Dashboard')

@section('content')
<div class="space-y-6">
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl lg:text-3xl font-bold font-display text-[#0e171b]">Dashboard Penjual</h1>
            <p class="text-[#4d8199] mt-1">Selamat datang, {{ $user->shop_name }}!</p>
        </div>
        <div class="text-sm text-[#4d8199]">
            {{ now()->translatedFormat('l, d F Y') }}
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
        <!-- Total Produk -->
        <div class="bg-white rounded-2xl p-5 border border-[#d0e0e7] hover:shadow-lg transition-shadow">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-blue-100 flex items-center justify-center">
                    <span class="material-symbols-outlined text-blue-600">inventory_2</span>
                </div>
                <div>
                    <p class="text-2xl font-bold text-[#0e171b]">{{ number_format($totalProducts) }}</p>
                    <p class="text-sm text-[#4d8199]">Total Produk</p>
                </div>
            </div>
        </div>

        <!-- Total Stok -->
        <div class="bg-white rounded-2xl p-5 border border-[#d0e0e7] hover:shadow-lg transition-shadow">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-green-100 flex items-center justify-center">
                    <span class="material-symbols-outlined text-green-600">package_2</span>
                </div>
                <div>
                    <p class="text-2xl font-bold text-[#0e171b]">{{ number_format($totalStock) }}</p>
                    <p class="text-sm text-[#4d8199]">Total Stok</p>
                </div>
            </div>
        </div>

        <!-- Stok Rendah -->
        <div class="bg-white rounded-2xl p-5 border border-[#d0e0e7] hover:shadow-lg transition-shadow">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-red-100 flex items-center justify-center">
                    <span class="material-symbols-outlined text-red-600">warning</span>
                </div>
                <div>
                    <p class="text-2xl font-bold text-[#0e171b]">{{ number_format($lowStockCount) }}</p>
                    <p class="text-sm text-[#4d8199]">Stok Rendah</p>
                </div>
            </div>
        </div>

        <!-- Total Review -->
        <div class="bg-white rounded-2xl p-5 border border-[#d0e0e7] hover:shadow-lg transition-shadow">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-purple-100 flex items-center justify-center">
                    <span class="material-symbols-outlined text-purple-600">rate_review</span>
                </div>
                <div>
                    <p class="text-2xl font-bold text-[#0e171b]">{{ number_format($totalReviews) }}</p>
                    <p class="text-sm text-[#4d8199]">Total Review</p>
                </div>
            </div>
        </div>

        <!-- Rata-rata Rating -->
        <div class="bg-white rounded-2xl p-5 border border-[#d0e0e7] hover:shadow-lg transition-shadow">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-yellow-100 flex items-center justify-center">
                    <span class="material-symbols-outlined text-yellow-600">star</span>
                </div>
                <div>
                    <p class="text-2xl font-bold text-[#0e171b]">{{ number_format($averageRating, 1) }}</p>
                    <p class="text-sm text-[#4d8199]">Rata-rata Rating</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Sebaran Stok per Produk -->
        <div class="bg-white rounded-2xl p-6 border border-[#d0e0e7]">
            <h3 class="text-lg font-bold font-display text-[#0e171b] mb-4">Sebaran Stok per Produk</h3>
            <div class="h-[300px]">
                <canvas id="stockChart"></canvas>
            </div>
        </div>

        <!-- Sebaran Rating per Produk -->
        <div class="bg-white rounded-2xl p-6 border border-[#d0e0e7]">
            <h3 class="text-lg font-bold font-display text-[#0e171b] mb-4">Sebaran Rating per Produk</h3>
            <div class="h-[300px]">
                <canvas id="ratingChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Full Width Chart -->
    <div class="bg-white rounded-2xl p-6 border border-[#d0e0e7]">
        <h3 class="text-lg font-bold font-display text-[#0e171b] mb-4">Sebaran Pemberi Rating Berdasarkan Provinsi</h3>
        <div class="h-[350px]">
            <canvas id="provinceChart"></canvas>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="bg-white rounded-2xl p-6 border border-[#d0e0e7]">
        <h3 class="text-lg font-bold font-display text-[#0e171b] mb-4">Aksi Cepat</h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <a href="{{ route('seller.products.create') }}" 
               class="flex items-center gap-3 p-4 rounded-xl bg-primary/10 hover:bg-primary/20 transition-colors group">
                <div class="w-10 h-10 rounded-lg bg-primary flex items-center justify-center">
                    <span class="material-symbols-outlined text-white">add</span>
                </div>
                <div>
                    <p class="font-semibold text-[#0e171b]">Tambah Produk</p>
                    <p class="text-xs text-[#4d8199]">Buat produk baru</p>
                </div>
            </a>

            <a href="{{ route('seller.reports.index') }}" 
               class="flex items-center gap-3 p-4 rounded-xl bg-green-50 hover:bg-green-100 transition-colors group">
                <div class="w-10 h-10 rounded-lg bg-green-500 flex items-center justify-center">
                    <span class="material-symbols-outlined text-white">download</span>
                </div>
                <div>
                    <p class="font-semibold text-[#0e171b]">Unduh Laporan</p>
                    <p class="text-xs text-[#4d8199]">Laporan stok & rating</p>
                </div>
            </a>

            <a href="{{ route('seller.settings') }}" 
               class="flex items-center gap-3 p-4 rounded-xl bg-purple-50 hover:bg-purple-100 transition-colors group">
                <div class="w-10 h-10 rounded-lg bg-purple-500 flex items-center justify-center">
                    <span class="material-symbols-outlined text-white">settings</span>
                </div>
                <div>
                    <p class="font-semibold text-[#0e171b]">Pengaturan</p>
                    <p class="text-xs text-[#4d8199]">Kelola profil toko</p>
                </div>
            </a>

            <a href="{{ route('shops.show', auth()->user()) }}" 
               class="flex items-center gap-3 p-4 rounded-xl bg-orange-50 hover:bg-orange-100 transition-colors group">
                <div class="w-10 h-10 rounded-lg bg-orange-500 flex items-center justify-center">
                    <span class="material-symbols-outlined text-white">storefront</span>
                </div>
                <div>
                    <p class="font-semibold text-[#0e171b]">Lihat Toko</p>
                    <p class="text-xs text-[#4d8199]">Tampilan publik toko</p>
                </div>
            </a>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    fetch('{{ route("seller.chart-data") }}')
        .then(response => response.json())
        .then(data => {
            // Chart 1: Sebaran Stok per Produk (Bar Chart)
            const stockCtx = document.getElementById('stockChart').getContext('2d');
            new Chart(stockCtx, {
                type: 'bar',
                data: {
                    labels: data.stockDistribution.map(item => item.name.length > 15 ? item.name.substring(0, 15) + '...' : item.name),
                    datasets: [{
                        label: 'Jumlah Stok',
                        data: data.stockDistribution.map(item => item.stock),
                        backgroundColor: 'rgba(36, 172, 235, 0.8)',
                        borderColor: 'rgba(36, 172, 235, 1)',
                        borderWidth: 1,
                        borderRadius: 6,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false }
                    },
                    scales: {
                        y: { 
                            beginAtZero: true,
                            grid: { color: 'rgba(0,0,0,0.05)' }
                        },
                        x: {
                            grid: { display: false },
                            ticks: { maxRotation: 45, minRotation: 45 }
                        }
                    }
                }
            });

            // Chart 2: Sebaran Rating per Produk (Horizontal Bar)
            const ratingCtx = document.getElementById('ratingChart').getContext('2d');
            new Chart(ratingCtx, {
                type: 'bar',
                data: {
                    labels: data.ratingDistribution.map(item => item.name.length > 15 ? item.name.substring(0, 15) + '...' : item.name),
                    datasets: [{
                        label: 'Rating',
                        data: data.ratingDistribution.map(item => item.rating),
                        backgroundColor: 'rgba(245, 158, 11, 0.8)',
                        borderColor: 'rgba(245, 158, 11, 1)',
                        borderWidth: 1,
                        borderRadius: 6,
                    }]
                },
                options: {
                    indexAxis: 'y',
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false }
                    },
                    scales: {
                        x: { 
                            beginAtZero: true,
                            max: 5,
                            grid: { color: 'rgba(0,0,0,0.05)' }
                        },
                        y: {
                            grid: { display: false }
                        }
                    }
                }
            });

            // Chart 3: Sebaran Pemberi Rating per Provinsi (Doughnut)
            const provinceCtx = document.getElementById('provinceChart').getContext('2d');
            const provinceColors = [
                '#24aceb', '#10b981', '#f59e0b', '#ef4444', '#8b5cf6',
                '#ec4899', '#06b6d4', '#84cc16', '#f97316', '#6366f1'
            ];
            
            if (data.reviewersByProvince && data.reviewersByProvince.length > 0) {
                new Chart(provinceCtx, {
                    type: 'doughnut',
                    data: {
                        labels: data.reviewersByProvince.map(item => item.provinsi),
                        datasets: [{
                            data: data.reviewersByProvince.map(item => item.count),
                            backgroundColor: provinceColors,
                            borderWidth: 2,
                            borderColor: '#fff',
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                position: 'right',
                                labels: {
                                    padding: 15,
                                    usePointStyle: true,
                                    pointStyle: 'circle',
                                }
                            }
                        }
                    }
                });
            } else {
                document.getElementById('provinceChart').parentElement.innerHTML = `
                    <div class="h-full flex items-center justify-center text-[#4d8199]">
                        <div class="text-center">
                            <span class="material-symbols-outlined text-4xl mb-2">info</span>
                            <p>Belum ada data review dengan lokasi provinsi</p>
                        </div>
                    </div>
                `;
            }
        })
        .catch(error => {
            console.error('Error fetching chart data:', error);
        });
});
</script>
@endpush
