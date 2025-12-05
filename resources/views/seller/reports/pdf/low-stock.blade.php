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
            border-bottom: 3px solid #ef4444;
            margin-bottom: 25px;
        }
        
        .header h1 {
            font-size: 16pt;
            color: #ef4444;
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
        
        .header .warning-text {
            font-size: 11pt;
            color: #ef4444;
            font-weight: bold;
            margin-top: 5px;
        }
        
        .header .date {
            font-size: 10pt;
            color: #666;
            margin-top: 8px;
        }
        
        .alert-box {
            background-color: #fef2f2;
            border: 2px solid #ef4444;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 20px;
            text-align: center;
        }
        
        .alert-box .icon {
            font-size: 24pt;
            color: #ef4444;
        }
        
        .alert-box .text {
            font-size: 11pt;
            color: #991b1b;
            margin-top: 5px;
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
            background-color: #ef4444;
            color: white;
            font-weight: bold;
        }
        
        tr:nth-child(even) {
            background-color: #fef2f2;
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
        
        .price {
            color: #10b981;
            font-weight: bold;
        }
        
        .stock-critical {
            background-color: #ef4444;
            color: white;
            font-weight: bold;
            padding: 3px 8px;
            border-radius: 4px;
        }
        
        .stock-zero {
            background-color: #7f1d1d;
            color: white;
            font-weight: bold;
            padding: 3px 8px;
            border-radius: 4px;
        }
        
        .summary {
            margin-top: 20px;
            padding: 15px;
            background-color: #fef2f2;
            border-radius: 8px;
            border-left: 4px solid #ef4444;
        }
        
        .summary-title {
            font-weight: bold;
            color: #991b1b;
            margin-bottom: 10px;
        }
        
        .action-required {
            margin-top: 20px;
            padding: 15px;
            background-color: #fff7ed;
            border-radius: 8px;
            border-left: 4px solid #f97316;
        }
        
        .action-title {
            font-weight: bold;
            color: #c2410c;
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
        <div class="warning-text">⚠ {{ $subtitle }}</div>
        <div class="date">Dicetak pada: {{ $generatedAt }}</div>
    </div>

    @if(count($products) > 0)
    <div class="alert-box">
        <div class="icon">⚠</div>
        <div class="text">
            <strong>PERHATIAN!</strong> Terdapat {{ count($products) }} produk yang memerlukan pemesanan ulang segera.
        </div>
    </div>
    @endif

    <table>
        <thead>
            <tr>
                <th style="width: 5%">No</th>
                <th style="width: 30%">Nama Produk</th>
                <th style="width: 12%">Stok</th>
                <th style="width: 18%">Kategori</th>
                <th style="width: 20%">Harga</th>
                <th style="width: 15%">Rating</th>
            </tr>
        </thead>
        <tbody>
            @forelse($products as $index => $product)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>{{ $product['name'] }}</td>
                <td class="text-center">
                    <span class="{{ $product['stock'] == 0 ? 'stock-zero' : 'stock-critical' }}">
                        {{ $product['stock'] == 0 ? 'HABIS' : $product['stock'] }}
                    </span>
                </td>
                <td>{{ $product['category'] }}</td>
                <td class="text-right price">Rp {{ number_format($product['price'], 0, ',', '.') }}</td>
                <td class="text-center rating">
                    @if($product['rating'] > 0)
                        ★ {{ number_format($product['rating'], 1) }}
                    @else
                        -
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center" style="color: #10b981; font-weight: bold;">
                    ✓ Tidak ada produk dengan stok rendah. Semua produk memiliki stok yang cukup.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    @if(count($products) > 0)
    <div class="summary">
        <div class="summary-title">⚠ Ringkasan Stok Kritis</div>
        <table style="border: none; margin: 0;">
            <tr style="background: none;">
                <td style="border: none; padding: 3px 0;">Total Produk Stok Rendah</td>
                <td style="border: none; padding: 3px 0; text-align: right; font-weight: bold; color: #ef4444;">{{ count($products) }} produk</td>
            </tr>
            <tr style="background: none;">
                <td style="border: none; padding: 3px 0;">Produk Stok Habis (0)</td>
                <td style="border: none; padding: 3px 0; text-align: right; font-weight: bold; color: #7f1d1d;">{{ $products->where('stock', 0)->count() }} produk</td>
            </tr>
            <tr style="background: none;">
                <td style="border: none; padding: 3px 0;">Produk Stok = 1</td>
                <td style="border: none; padding: 3px 0; text-align: right; font-weight: bold; color: #ef4444;">{{ $products->where('stock', 1)->count() }} produk</td>
            </tr>
        </table>
    </div>

    <div class="action-required">
        <div class="action-title">📋 Tindakan yang Diperlukan</div>
        <ol style="margin: 0; padding-left: 20px; font-size: 10pt; color: #c2410c;">
            <li>Segera lakukan pemesanan ulang untuk produk dengan stok habis</li>
            <li>Prioritaskan produk dengan rating tinggi untuk menjaga kepuasan pelanggan</li>
            <li>Hubungi supplier untuk memastikan ketersediaan barang</li>
            <li>Perbarui informasi stok di sistem setelah barang tiba</li>
        </ol>
    </div>
    @endif

    <div class="footer">
        LapakMahasiswa - Marketplace untuk Mahasiswa Indonesia<br>
        Laporan ini dibuat oleh: {{ $generatedBy }}
    </div>
</body>
</html>
