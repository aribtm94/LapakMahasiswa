<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>{{ $title }}</title>
    <style>
        /* Margin standar surat formal (landscape): atas 3cm, bawah 3cm, kiri 4cm, kanan 3cm */
        @page {
            margin: 0;
            size: landscape;
        }
        
        html, body {
            margin: 0;
            padding: 0;
        }
        
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 10pt;
            line-height: 1.4;
            color: #333;
            /* Padding sebagai pengganti margin @page */
            padding: 30mm 30mm 30mm 40mm;
        }
        
        .header {
            text-align: center;
            padding-bottom: 15px;
            border-bottom: 3px solid #24aceb;
            margin-bottom: 20px;
        }
        
        .header h1 {
            font-size: 16pt;
            color: #24aceb;
            margin-bottom: 5px;
        }
        
        .header .subtitle {
            font-size: 13pt;
            color: #333;
            font-weight: bold;
        }
        
        .header .date {
            font-size: 10pt;
            color: #666;
            margin-top: 8px;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }
        
        th, td {
            padding: 8px 10px;
            text-align: left;
            border: 1px solid #ddd;
            font-size: 9pt;
        }
        
        th {
            background-color: #24aceb;
            color: white;
            font-weight: bold;
        }
        
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        
        .rating-stars {
            color: #f59e0b;
            font-size: 11pt;
        }
        
        .rating-value {
            font-weight: bold;
            color: #f59e0b;
        }
        
        .price {
            font-weight: bold;
            color: #10b981;
        }
        
        .footer {
            position: fixed;
            bottom: -10mm;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 8pt;
            color: #999;
            border-top: 1px solid #ddd;
            padding-top: 8px;
        }
        
        .summary-box {
            background-color: #f0f7fc;
            border: 2px solid #24aceb;
            border-radius: 8px;
            padding: 12px;
            margin-bottom: 15px;
        }
        
        .summary-box h3 {
            font-size: 10pt;
            color: #24aceb;
            margin-bottom: 10px;
            text-align: center;
        }
        
        .summary-grid {
            display: table;
            width: 100%;
        }
        
        .summary-item {
            display: table-cell;
            text-align: center;
            padding: 8px;
            border-right: 1px solid #ddd;
        }
        
        .summary-item:last-child {
            border-right: none;
        }
        
        .summary-number {
            font-size: 16pt;
            font-weight: bold;
            color: #24aceb;
        }
        
        .summary-label {
            font-size: 8pt;
            color: #666;
        }
        
        .no-data {
            text-align: center;
            padding: 20px;
            color: #999;
            font-style: italic;
        }
        
        .rank-badge {
            display: inline-block;
            width: 22px;
            height: 22px;
            line-height: 22px;
            text-align: center;
            border-radius: 50%;
            font-size: 8pt;
            font-weight: bold;
        }
        
        .rank-1 { background-color: #ffd700; color: #333; }
        .rank-2 { background-color: #c0c0c0; color: #333; }
        .rank-3 { background-color: #cd7f32; color: #fff; }
        .rank-other { background-color: #e8eef3; color: #666; }
    </style>
</head>
<body>
    <div class="header">
        <h1>LAPAK MAHASISWA</h1>
        <div class="subtitle">{{ $title }}</div>
        <div class="date">Dibuat pada: {{ $generatedAt }} oleh {{ $generatedBy }}</div>
    </div>

    <!-- Summary -->
    <div class="summary-box">
        <h3>RINGKASAN STATISTIK PRODUK</h3>
        <div class="summary-grid">
            <div class="summary-item">
                <div class="summary-number">{{ $products->count() }}</div>
                <div class="summary-label">Total Produk</div>
            </div>
            <div class="summary-item">
                <div class="summary-number">{{ $products->where('reviews_count', '>', 0)->count() }}</div>
                <div class="summary-label">Produk Memiliki Rating</div>
            </div>
            <div class="summary-item">
                <div class="summary-number">{{ number_format($products->avg('average_rating'), 1) }}</div>
                <div class="summary-label">Rata-rata Rating</div>
            </div>
            <div class="summary-item">
                <div class="summary-number">{{ $products->sum('reviews_count') }}</div>
                <div class="summary-label">Total Review</div>
            </div>
        </div>
    </div>

    <!-- Products Table -->
    @if($products->count() > 0)
    <table>
        <thead>
            <tr>
                <th style="width: 35px;">Rank</th>
                <th style="width: 20%;">Nama Produk</th>
                <th style="width: 15%;">Nama Toko</th>
                <th style="width: 12%;">Kategori</th>
                <th style="width: 10%;">Harga</th>
                <th style="width: 12%;">Provinsi</th>
                <th style="width: 8%;">Rating</th>
                <th style="width: 8%;">Review</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $index => $product)
            <tr>
                <td style="text-align: center;">
                    @if($index == 0)
                        <span class="rank-badge rank-1">1</span>
                    @elseif($index == 1)
                        <span class="rank-badge rank-2">2</span>
                    @elseif($index == 2)
                        <span class="rank-badge rank-3">3</span>
                    @else
                        <span class="rank-badge rank-other">{{ $index + 1 }}</span>
                    @endif
                </td>
                <td><strong>{{ \Illuminate\Support\Str::limit($product['name'], 35) }}</strong></td>
                <td>{{ \Illuminate\Support\Str::limit($product['shop_name'], 20) }}</td>
                <td>{{ $product['category'] }}</td>
                <td class="price">Rp {{ number_format($product['price'], 0, ',', '.') }}</td>
                <td>{{ \Illuminate\Support\Str::limit($product['province'], 18) }}</td>
                <td style="text-align: center;">
                    <span class="rating-value">{{ number_format($product['average_rating'], 1) }}</span>
                    <span class="rating-stars">★</span>
                </td>
                <td style="text-align: center;">{{ $product['reviews_count'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <div class="no-data">Belum ada data produk</div>
    @endif

    <div class="footer">
        LapakMahasiswa - Marketplace Mahasiswa Indonesia | Laporan diurutkan berdasarkan rating tertinggi | Halaman {PAGE_NUM} dari {PAGE_COUNT}
    </div>
</body>
</html>
