<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Registrasi Penjual</title>
    <style>label{display:block;margin-top:8px;}input,textarea{width:100%;max-width:600px;padding:6px;} .error{color:#b00;} .status{color:#060;}</style>
</head>
<body>
<h1>Registrasi Penjual</h1>
@if(session('status'))<p class="status">{{ session('status') }}</p>@endif
@if($errors->any())
    <div class="error">
        <ul>
            @foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach
        </ul>
    </div>
@endif
<form method="POST" action="{{ route('seller.register.store') }}" enctype="multipart/form-data">
    @csrf
    <label>Nama Toko<input name="shop_name" value="{{ old('shop_name') }}" required></label>
    <label>Deskripsi Singkat<textarea name="shop_description">{{ old('shop_description') }}</textarea></label>
    <label>Nama PIC<input name="pic_name" value="{{ old('pic_name') }}" required></label>
    <label>No HP PIC<input name="pic_phone" value="{{ old('pic_phone') }}" required></label>
    <label>Email PIC<input type="email" name="pic_email" value="{{ old('pic_email') }}" required></label>
    <label>Alamat PIC<textarea name="pic_address" required>{{ old('pic_address') }}</textarea></label>
    <label>RT<input name="rt" value="{{ old('rt') }}"></label>
    <label>RW<input name="rw" value="{{ old('rw') }}"></label>
    <label>Kelurahan<input name="kelurahan" value="{{ old('kelurahan') }}"></label>
    <label>Kabupaten/Kota<input name="kota" value="{{ old('kota') }}"></label>
    <label>Provinsi<input name="provinsi" value="{{ old('provinsi') }}"></label>
    <label>No KTP PIC<input name="pic_id_number" value="{{ old('pic_id_number') }}" required></label>
    <label>Foto KTP PIC<input type="file" name="pic_id_photo" required accept="image/*"></label>
    <label>Foto PIC<input type="file" name="pic_photo" required accept="image/*"></label>
    <button type="submit">Kirim Registrasi</button>
</form>
</body>
</html>
