<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <style>
        /* Margin standar surat formal: atas 3cm, bawah 3cm, kiri 4cm, kanan 3cm */
        @page {
            margin: 30mm 30mm 30mm 40mm;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            font-size: 11pt;
            line-height: 1.5;
            color: #333;
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
        
        .section {
            margin-bottom: 25px;
        }
        
        .section-title {
            font-size: 12pt;
            font-weight: bold;
            color: #24aceb;
            padding: 8px 12px;
            background-color: #e8f4fc;
            border-left: 4px solid #24aceb;
            margin-bottom: 12px;
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
            font-size: 10pt;
        }
        
        th {
            background-color: #24aceb;
            color: white;
            font-weight: bold;
        }
        
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        
        tr:hover {
            background-color: #f0f7fc;
        }
        
        .badge {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 12px;
            font-size: 8pt;
            font-weight: bold;
        }
        
        .badge-active {
            background-color: #d1fae5;
            color: #065f46;
        }
        
        .badge-pending {
            background-color: #fef3c7;
            color: #92400e;
        }
        
        .badge-rejected {
            background-color: #fee2e2;
            color: #991b1b;
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
            background-color: #f8f9fa;
            border: 1px solid #e8eef3;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 20px;
        }
        
        .summary-box h3 {
            font-size: 11pt;
            color: #333;
            margin-bottom: 10px;
        }
        
        .summary-stats {
            display: flex;
            gap: 20px;
        }
        
        .stat-item {
            text-align: center;
        }
        
        .stat-number {
            font-size: 18pt;
            font-weight: bold;
            color: #24aceb;
        }
        
        .stat-label {
            font-size: 8pt;
            color: #666;
        }
        
        .no-data {
            text-align: center;
            padding: 20px;
            color: #999;
            font-style: italic;
        }
        
        .page-break {
            page-break-after: always;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>LAPAK MAHASISWA</h1>
        <div class="subtitle">{{ $title }}</div>
        <div class="date">Dibuat pada: {{ $generatedAt }} oleh {{ $generatedBy }}</div>
    </div>

    @yield('content')

    <div class="footer">
        LapakMahasiswa - Marketplace Mahasiswa Indonesia | Dokumen ini digenerate secara otomatis
    </div>
</body>
</html>
