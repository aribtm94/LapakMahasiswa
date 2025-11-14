<!DOCTYPE html>
<html lang="id">
<head><meta charset="UTF-8"><title>Detail Penjual</title><style>dt{font-weight:bold}dd{margin-bottom:6px}</style></head>
<body>
<a href="{{ route('admin.sellers.index') }}">&larr; Kembali</a>
<h1>Detail Penjual: {{ $user->shop_name }}</h1>
<dl>
    <dt>Nama Toko</dt><dd>{{ $user->shop_name }}</dd>
    <dt>Deskripsi</dt><dd>{{ $user->shop_description }}</dd>
    <dt>Nama PIC</dt><dd>{{ $user->pic_name }}</dd>
    <dt>No HP</dt><dd>{{ $user->pic_phone }}</dd>
    <dt>Email</dt><dd>{{ $user->pic_email }}</dd>
    <dt>Alamat</dt><dd>{{ $user->pic_address }} RT {{ $user->rt }} / RW {{ $user->rw }}, Kel. {{ $user->kelurahan }}, Kota {{ $user->kota }}, Prov. {{ $user->provinsi }}</dd>
    <dt>No KTP</dt><dd>{{ $user->pic_id_number }}</dd>
    <dt>Foto KTP</dt><dd>@if($user->pic_id_photo_path)<img src="{{ asset('storage/'.$user->pic_id_photo_path) }}" alt width="200">@endif</dd>
    <dt>Foto PIC</dt><dd>@if($user->pic_photo_path)<img src="{{ asset('storage/'.$user->pic_photo_path) }}" alt width="200">@endif</dd>
</dl>
@if($user->seller_status==='pending')
<form method="POST" action="{{ route('admin.sellers.approve',$user) }}" style="display:inline-block;">@csrf<button type="submit">Setujui</button></form>
<form method="POST" action="{{ route('admin.sellers.reject',$user) }}" style="display:inline-block; margin-left:12px;">@csrf
    <input name="reason" placeholder="Alasan penolakan" required style="width:300px;">
    <button type="submit">Tolak</button>
</form>
@else
<p>Status: {{ $user->seller_status }}</p>
@endif
</body></html>
