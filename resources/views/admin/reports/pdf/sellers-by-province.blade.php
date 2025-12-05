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
            border-bottom: 3px solid #24aceb;
            margin-bottom: 25px;
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
        
        .province-section {
            margin-bottom: 25px;
            page-break-inside: avoid;
        }
        
        .province-header {
            font-size: 12pt;
            font-weight: bold;
            color: #fff;
            padding: 10px 15px;
            background: linear-gradient(135deg, #24aceb, #1a8bc7);
            margin-bottom: 12px;
        }
        
        .province-count {
            float: right;
            background-color: rgba(255,255,255,0.2);
            padding: 2px 10px;
            border-radius: 12px;
            font-size: 10pt;
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
            background-color: #e8f4fc;
            color: #24aceb;
            font-weight: bold;
        }
        
        tr:nth-child(even) {
            background-color: #f9f9f9;
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
            padding-top: 10px;
        }
        
        .summary-box {
            background-color: #f0f7fc;
            border: 2px solid #24aceb;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 20px;
        }
        
        .summary-box h3 {
            font-size: 11pt;
            color: #24aceb;
            margin-bottom: 15px;
            text-align: center;
        }
        
        .summary-grid {
            display: table;
            width: 100%;
        }
        
        .summary-item {
            display: table-cell;
            text-align: center;
            padding: 10px;
            border-right: 1px solid #ddd;
        }
        
        .summary-item:last-child {
            border-right: none;
        }
        
        .summary-number {
            font-size: 20pt;
            font-weight: bold;
            color: #24aceb;
        }
        
        .summary-label {
            font-size: 9pt;
            color: #666;
        }
        
        .no-data {
            text-align: center;
            padding: 20px;
            color: #999;
            font-style: italic;
        }
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
        <h3>RINGKASAN SEBARAN PENJUAL PER PROVINSI</h3>
        <div class="summary-grid">
            <div class="summary-item">
                <div class="summary-number">{{ $sellersByProvince->count() }}</div>
                <div class="summary-label">Total Provinsi</div>
            </div>
            <div class="summary-item">
                <div class="summary-number">{{ $sellersByProvince->flatten()->count() }}</div>
                <div class="summary-label">Total Penjual</div>
            </div>
            <div class="summary-item">
                <div class="summary-number">{{ $sellersByProvince->count() > 0 ? number_format($sellersByProvince->flatten()->count() / $sellersByProvince->count(), 1) : 0 }}</div>
                <div class="summary-label">Rata-rata per Provinsi</div>
            </div>
        </div>
    </div>

    <!-- Sellers by Province -->
    @forelse($sellersByProvince as $province => $sellers)
    <div class="province-section">
        <div class="province-header">
            {{ $province ?: 'Provinsi Tidak Diketahui' }}
            <span class="province-count">{{ $sellers->count() }} Penjual</span>
        </div>
        
        <table>
            <thead>
                <tr>
                    <th style="width: 30px;">No</th>
                    <th>Nama Toko</th>
                    <th>Pemilik</th>
                    <th>Email</th>
                    <th>Kota/Kabupaten</th>
                    <th>Kecamatan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($sellers as $index => $seller)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td><strong>{{ $seller->shop_name ?? '-' }}</strong></td>
                    <td>{{ $seller->name }}</td>
                    <td>{{ $seller->email }}</td>
                    <td>{{ $seller->kota ?? '-' }}</td>
                    <td>{{ $seller->kecamatan ?? '-' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @empty
    <div class="no-data">Belum ada data penjual berdasarkan provinsi</div>
    @endforelse

    <div class="footer">
        LapakMahasiswa - Marketplace Mahasiswa Indonesia | Halaman {PAGE_NUM} dari {PAGE_COUNT}
    </div>
</body>
</html>
