<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ulasan Baru - LapakMahasiswa</title>
</head>
<body style="margin: 0; padding: 0; font-family: 'Segoe UI', Arial, sans-serif; background-color: #f6f7f8;">
    <table width="100%" cellpadding="0" cellspacing="0" style="background-color: #f6f7f8; padding: 40px 20px;">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0" style="background-color: #ffffff; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 6px rgba(0,0,0,0.05);">
                    <!-- Header -->
                    <tr>
                        <td style="background: linear-gradient(135deg, #24aceb 0%, #1a8bc7 100%); padding: 40px 30px; text-align: center;">
                            <h1 style="color: #ffffff; margin: 0; font-size: 28px; font-weight: bold;">LapakMahasiswa</h1>
                            <p style="color: rgba(255,255,255,0.9); margin: 10px 0 0; font-size: 14px;">Marketplace Mahasiswa Terpercaya</p>
                        </td>
                    </tr>
                    
                    <!-- Content -->
                    <tr>
                        <td style="padding: 40px 30px;">
                            <!-- Icon -->
                            <div style="text-align: center; margin-bottom: 30px;">
                                <div style="display: inline-block; width: 80px; height: 80px; background-color: #fff3cd; border-radius: 50%; line-height: 80px;">
                                    <span style="font-size: 40px;">⭐</span>
                                </div>
                            </div>
                            
                            <h2 style="color: #0e171b; font-size: 24px; margin: 0 0 20px; text-align: center;">
                                Ulasan Baru untuk Produk Anda!
                            </h2>
                            
                            <p style="color: #4d8199; font-size: 16px; line-height: 1.6; margin: 0 0 30px; text-align: center;">
                                Halo! Ada pelanggan yang memberikan ulasan untuk produk Anda.
                            </p>
                            
                            <!-- Product Info Box -->
                            <div style="background-color: #f8fafc; border-radius: 12px; padding: 25px; margin-bottom: 25px; border: 1px solid #e2e8f0;">
                                <h3 style="color: #0e171b; font-size: 14px; margin: 0 0 15px; text-transform: uppercase; letter-spacing: 0.5px;">
                                    Informasi Produk
                                </h3>
                                <p style="color: #0e171b; font-size: 18px; font-weight: bold; margin: 0 0 5px;">
                                    {{ $product->name }}
                                </p>
                                <p style="color: #4d8199; font-size: 14px; margin: 0;">
                                    Harga: Rp {{ number_format($product->price, 0, ',', '.') }}
                                </p>
                            </div>
                            
                            <!-- Review Box -->
                            <div style="background-color: #fffbeb; border-radius: 12px; padding: 25px; margin-bottom: 25px; border: 1px solid #fde68a;">
                                <h3 style="color: #0e171b; font-size: 14px; margin: 0 0 15px; text-transform: uppercase; letter-spacing: 0.5px;">
                                    Detail Ulasan
                                </h3>
                                
                                <table width="100%" cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td style="padding: 8px 0; color: #4d8199; font-size: 14px; width: 100px;">Dari:</td>
                                        <td style="padding: 8px 0; color: #0e171b; font-size: 14px; font-weight: bold;">{{ $review->name }}</td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 8px 0; color: #4d8199; font-size: 14px;">Email:</td>
                                        <td style="padding: 8px 0; color: #0e171b; font-size: 14px;">{{ $review->email }}</td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 8px 0; color: #4d8199; font-size: 14px; vertical-align: top;">Rating:</td>
                                        <td style="padding: 8px 0; color: #f59e0b; font-size: 18px;">
                                            @for($i = 1; $i <= 5; $i++)
                                                {{ $i <= $review->rating ? '★' : '☆' }}
                                            @endfor
                                            <span style="color: #0e171b; font-size: 14px; margin-left: 5px;">({{ $review->rating }}/5)</span>
                                        </td>
                                    </tr>
                                </table>
                                
                                <div style="margin-top: 15px; padding-top: 15px; border-top: 1px solid #fde68a;">
                                    <p style="color: #4d8199; font-size: 12px; margin: 0 0 8px; text-transform: uppercase; letter-spacing: 0.5px;">Komentar:</p>
                                    <p style="color: #0e171b; font-size: 15px; line-height: 1.6; margin: 0; font-style: italic;">
                                        "{{ $review->comment }}"
                                    </p>
                                </div>
                            </div>
                            
                            <!-- Stats Box -->
                            <div style="background-color: #f0fdf4; border-radius: 12px; padding: 20px; margin-bottom: 30px; border: 1px solid #bbf7d0; text-align: center;">
                                <p style="color: #4d8199; font-size: 14px; margin: 0 0 5px;">Rating Rata-rata Produk Saat Ini</p>
                                <p style="color: #0e171b; font-size: 28px; font-weight: bold; margin: 0;">
                                    {{ number_format($product->average_rating, 1) }} <span style="font-size: 18px; color: #f59e0b;">★</span>
                                </p>
                                <p style="color: #4d8199; font-size: 12px; margin: 5px 0 0;">dari {{ $product->reviews_count }} ulasan</p>
                            </div>
                            
                            <!-- CTA Button -->
                            <div style="text-align: center;">
                                <a href="{{ url('/products/' . $product->id) }}" style="display: inline-block; background: linear-gradient(135deg, #24aceb 0%, #1a8bc7 100%); color: #ffffff; padding: 15px 40px; border-radius: 30px; text-decoration: none; font-weight: bold; font-size: 16px;">
                                    Lihat Produk
                                </a>
                            </div>
                        </td>
                    </tr>
                    
                    <!-- Footer -->
                    <tr>
                        <td style="background-color: #f8fafc; padding: 30px; text-align: center; border-top: 1px solid #e2e8f0;">
                            <p style="color: #64748b; font-size: 14px; margin: 0 0 10px;">
                                Terima kasih telah berjualan di LapakMahasiswa!
                            </p>
                            <p style="color: #94a3b8; font-size: 12px; margin: 0;">
                                Email ini dikirim otomatis, mohon tidak membalas email ini.
                            </p>
                            <p style="color: #94a3b8; font-size: 12px; margin: 15px 0 0;">
                                &copy; {{ date('Y') }} LapakMahasiswa. All rights reserved.
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
