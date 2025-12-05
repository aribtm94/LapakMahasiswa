<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>{{ $title }}</title>
    <style>
        /* Margin standar surat formal: atas 3cm, bawah 3cm, kiri 4cm, kanan 3cm */
        @page {
            margin: 0;
        }
        
        html, body {
            margin: 0;
            padding: 0;
        }
        
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 11pt;
            line-height: 1.5;
            color: #333;
            /* Padding sebagai pengganti margin @page */
            padding: 30mm 30mm 30mm 40mm;
        }
        
        .header {
            text-align: center;
            padding-bottom: 15px;
            border-bottom: 3px solid #f59e0b;
            margin-bottom: 25px;
        }
        
        .header h1 {
            font-size: 16pt;
            color: #f59e0b;
            margin-bottom: 5px;
        }
        
        .header .shop-name {
            font-size: 14pt;
            color: #333;
            font-weight: bold;
            margin-bottom: 5px;
        }
        
        .header .subtitle {
            font-size: 12pt;
            color: #333;
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
            padding: 10px 12px;
            text-align: left;
            border: 1px solid #ddd;
            font-size: 10pt;
        }
        
        th {
            background-color: #f59e0b;
            color: white;
            font-weight: bold;
        }
        
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        
        .text-right {
            text-align: right;
        }
        
        .text-center {
            text-align: center;
        }
        
        .rating {
            color: #f59e0b;
            font-weight: bold;
        }
        
        .rating-stars {
            color: #f59e0b;
        }
        
        .price {
            color: #10b981;
            font-weight: bold;
        }
        
        .stock {
            font-weight: bold;
        }
        
        .stock.high {
            color: #10b981;
        }
        
        .stock.medium {
            color: #f59e0b;
        }
        
        .stock.low {
            color: #ef4444;
        }
        
        .summary {
            margin-top: 20px;
            padding: 15px;
            background-color: #fffbeb;
            border-radius: 8px;
            border-left: 4px solid #f59e0b;
        }
        
        .summary-title {
            font-weight: bold;
            color: #0e171b;
            margin-bottom: 10px;
        }
        
        .footer {
            position: fixed;
            bottom: 20mm;
            left: 40mm;
            right: 30mm;
            text-align: center;
            font-size: 8pt;
            color: #999;
            border-top: 1px solid #ddd;
            padding-top: 8px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>LAPAKMAHASIWA</h1>
        <div class="shop-name">{{ $shopName }}</div>
        <div class="subtitle">{{ $title }}</div>
        <div class="date">Dicetak pada: {{ $generatedAt }}</div>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 5%">No</th>
                <th style="width: 30%">Nama Produk</th>
                <th style="width: 15%">Rating</th>
                <th style="width: 12%">Stok</th>
                <th style="width: 18%">Kategori</th>
                <th style="width: 20%">Harga</th>
            </tr>
        </thead>
        <tbody>
            @forelse($products as $index => $product)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>{{ $product['name'] }}</td>
                <td class="text-center">
                    @if($product['rating'] > 0)
                        <span class="rating-stars">
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= round($product['rating']))★@else☆@endif
                            @endfor
                        </span>
                        <br><span class="rating">{{ number_format($product['rating'], 1) }}</span>
                    @else
                        <span style="color: #999;">Belum ada</span>
                    @endif
                </td>
                <td class="text-center stock {{ $product['stock'] < 2 ? 'low' : ($product['stock'] < 10 ? 'medium' : 'high') }}">
                    {{ number_format($product['stock']) }}
                </td>
                <td>{{ $product['category'] }}</td>
                <td class="text-right price">Rp {{ number_format($product['price'], 0, ',', '.') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center">Tidak ada data produk</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="summary">
        <div class="summary-title">Ringkasan Rating</div>
        <table style="border: none; margin: 0;">
            <tr style="background: none;">
                <td style="border: none; padding: 3px 0;">Total Produk</td>
                <td style="border: none; padding: 3px 0; text-align: right; font-weight: bold;">{{ count($products) }} produk</td>
            </tr>
            <tr style="background: none;">
                <td style="border: none; padding: 3px 0;">Produk dengan Rating</td>
                <td style="border: none; padding: 3px 0; text-align: right; font-weight: bold;">{{ $products->where('rating', '>', 0)->count() }} produk</td>
            </tr>
            <tr style="background: none;">
                <td style="border: none; padding: 3px 0;">Rata-rata Rating</td>
                <td style="border: none; padding: 3px 0; text-align: right; font-weight: bold; color: #f59e0b;">
                    @php
                        $ratedProducts = $products->where('rating', '>', 0);
                        $avgRating = $ratedProducts->count() > 0 ? $ratedProducts->avg('rating') : 0;
                    @endphp
                    ★ {{ number_format($avgRating, 2) }}
                </td>
            </tr>
        </table>
    </div>

    <div class="footer">
        LapakMahasiswa - Marketplace untuk Mahasiswa Indonesia<br>
        Laporan ini dibuat oleh: {{ $generatedBy }}
    </div>
</body>
</html>
