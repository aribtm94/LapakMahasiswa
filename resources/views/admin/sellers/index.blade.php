<!DOCTYPE html>
<html lang="id">
<head><meta charset="UTF-8"><title>Admin - Seller Verification</title><style>table{border-collapse:collapse}td,th{border:1px solid #ccc;padding:4px 8px} .pending{background:#fff3cd} .approved{background:#d1e7dd} .rejected{background:#f8d7da}</style></head>
<body>
<h1>Dashboard Verifikasi Penjual</h1>
@if(session('status'))<p>{{ session('status') }}</p>@endif
<h2>Pending</h2>
<table><tr><th>Shop</th><th>PIC</th><th>Aksi</th></tr>
@foreach($pending as $u)
<tr class="pending"><td>{{ $u->shop_name }}</td><td>{{ $u->pic_name }}</td><td><a href="{{ route('admin.sellers.show',$u) }}">Detail</a></td></tr>
@endforeach</table>
<h2>Disetujui</h2>
<table><tr><th>Shop</th><th>PIC</th></tr>
@foreach($approved as $u)<tr class="approved"><td>{{ $u->shop_name }}</td><td>{{ $u->pic_name }}</td></tr>@endforeach</table>
<h2>Ditolak</h2>
<table><tr><th>Shop</th><th>PIC</th><th>Alasan</th></tr>
@foreach($rejected as $u)<tr class="rejected"><td>{{ $u->shop_name }}</td><td>{{ $u->pic_name }}</td><td>{{ $u->rejection_reason }}</td></tr>@endforeach</table>
</body></html>
