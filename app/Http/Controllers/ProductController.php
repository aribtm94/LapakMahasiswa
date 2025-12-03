<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductGuestReview;
use App\Models\ProductPhoto;
use App\Mail\NewReviewNotificationMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ProductController extends Controller
{
    public function create()
    {
        return view('seller.products.create');
    }

    // Daftar semua kategori yang valid
    private static $validCategories = [
        // Fashion & Aksesoris
        'fashion-wanita', 'fashion-pria', 'fashion-muslim', 'busana-anak-bayi',
        'sepatu-pria', 'sepatu-wanita', 'sandal-slipper', 'tas-wanita', 'tas-pria',
        'jam-tangan', 'aksesoris-fashion', 'emas-perhiasan', 'fashion-lokal-umkm',
        // Kecantikan & Kesehatan
        'kecantikan-perawatan', 'perawatan-kulit', 'kesehatan', 'kesehatan-herbal', 'ibu-bayi',
        // Rumah & Kehidupan
        'perlengkapan-rumah', 'dapur-masak', 'furnitur', 'dekorasi-rumah',
        'elektronik-rumah', 'peralatan-taman', 'pertukangan',
        // Elektronik & Gadget
        'handphone-aksesoris', 'laptop-aksesoris', 'komputer-komponen',
        'kamera-aksesoris', 'gaming-console', 'fotografi-videografi',
        // Hobi & Gaya Hidup
        'otomotif-mobil', 'otomotif-motor', 'hobi-koleksi', 'olahraga-outdoor',
        'camping-hiking', 'alat-musik', 'buku-alat-tulis',
        // Lainnya
        'software-voucher', 'tiket-travel', 'makanan-minuman', 'bahan-kue-sembako',
        'hewan-peliharaan', 'perlengkapan-sekolah', 'mainan-edukasi',
        'handmade-kerajinan', 'properti-kos', 'jasa-desain', 'jasa-servis',
    ];

    // Mapping kategori utama ke sub-kategori
    private static $categoryGroups = [
        'fashion' => [
            'fashion-wanita', 'fashion-pria', 'fashion-muslim', 'busana-anak-bayi',
            'sepatu-pria', 'sepatu-wanita', 'sandal-slipper', 'tas-wanita', 'tas-pria',
            'jam-tangan', 'aksesoris-fashion', 'emas-perhiasan', 'fashion-lokal-umkm',
        ],
        'kecantikan' => [
            'kecantikan-perawatan', 'perawatan-kulit', 'kesehatan', 'kesehatan-herbal', 'ibu-bayi',
        ],
        'rumah' => [
            'perlengkapan-rumah', 'dapur-masak', 'furnitur', 'dekorasi-rumah',
            'elektronik-rumah', 'peralatan-taman', 'pertukangan',
        ],
        'elektronik' => [
            'handphone-aksesoris', 'laptop-aksesoris', 'komputer-komponen',
            'kamera-aksesoris', 'gaming-console', 'fotografi-videografi',
        ],
        'hobi' => [
            'otomotif-mobil', 'otomotif-motor', 'hobi-koleksi', 'olahraga-outdoor',
            'camping-hiking', 'alat-musik', 'buku-alat-tulis',
        ],
        'lainnya' => [
            'software-voucher', 'tiket-travel', 'makanan-minuman', 'bahan-kue-sembako',
            'hewan-peliharaan', 'perlengkapan-sekolah', 'mainan-edukasi',
            'handmade-kerajinan', 'properti-kos', 'jasa-desain', 'jasa-servis',
        ],
    ];

    public static function getValidCategories()
    {
        return self::$validCategories;
    }

    public static function getCategoryGroups()
    {
        return self::$categoryGroups;
    }

    public static function getSubcategoriesByMainCategory($mainCategory)
    {
        return self::$categoryGroups[$mainCategory] ?? [];
    }

    public function store(Request $request)
    {
        $validCategoriesString = implode(',', self::$validCategories);
        
        $data = $request->validate([
            'name'        => 'required|string|max:255',
            'category'    => 'required|string|in:' . $validCategoriesString,
            'description' => 'nullable|string',
            'shop_name'   => 'nullable|string|max:255',
            'condition'   => 'nullable|string|max:50',
            'min_order'   => 'nullable|integer|min:1',
            'showcase'    => 'nullable|string|max:255',
            'price'       => 'required|integer|min:0',
            'stock'       => 'nullable|integer|min:0',
            'photos'      => 'required|array|min:1',
            'photos.*'    => 'image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $user = $request->user();

        $product = Product::create([
            'user_id'        => $user->id,
            'name'           => $data['name'],
            'category'       => $data['category'],
            'description'    => $data['description'] ?? null,
            'shop_name'      => $data['shop_name'] ?? $user->shop_name,
            'condition'      => $data['condition'] ?? 'baru',
            'min_order'      => $data['min_order'] ?? 1,
            'showcase'       => $data['showcase'] ?? null,
            'price'          => $data['price'],
            'average_rating' => 0,
            'reviews_count'  => 0,
            'sold_count'     => 0,
            'stock'          => $data['stock'] ?? 0,
        ]);

        foreach ($request->file('photos') as $index => $file) {
            $path = $file->store('products', 'public');

            ProductPhoto::create([
                'product_id' => $product->id,
                'path'       => $path,
                'is_cover'   => $index === 0,
            ]);
        }

        return redirect()->route('products.show', $product)
            ->with('status', 'Produk berhasil dibuat.');
    }
    public function show(Product $product)
    {
        // hitung rating rata-rata dari review tamu
        $product->load(['photos', 'guestReviews']);

        $averageRating = $product->guestReviews()->avg('rating') ?? 0;
        $reviewsCount  = $product->guestReviews()->count();

        // distribusi rating (1–5) untuk progress bar
        $ratingCounts = [];
        for ($i = 1; $i <= 5; $i++) {
            $ratingCounts[$i] = $product->guestReviews()
                ->where('rating', $i)
                ->count();
        }

        return view('products.show', [
            'product'       => $product,
            'averageRating' => round($averageRating, 1),
            'reviewsCount'  => $reviewsCount,
            'ratingCounts'  => $ratingCounts,
        ]);
    }

    public function storeGuestReview(Request $request, Product $product)
    {
        $data = $request->validate([
            'name'    => 'required|string|max:120',
            'email'   => 'required|email|max:150',
            'rating'  => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:1000',
        ]);

        $review = ProductGuestReview::create([
            'product_id' => $product->id,
            'name'       => $data['name'],
            'email'      => $data['email'],
            'rating'     => $data['rating'],
            'comment'    => $data['comment'],
        ]);

        $averageRating = $product->guestReviews()->avg('rating') ?? 0;
        $reviewsCount  = $product->guestReviews()->count();

        $product->update([
            'average_rating' => $averageRating,
            'reviews_count'  => $reviewsCount,
        ]);

        // Kirim email notifikasi ke penjual jika ada seller
        $product->refresh();
        if ($product->seller && $product->seller->email) {
            try {
                Mail::to($product->seller->email)->send(new NewReviewNotificationMail($review, $product));
            } catch (\Exception $e) {
                // Log error tapi tidak gagalkan proses
                \Log::error('Failed to send review notification email: ' . $e->getMessage());
            }
        }

        return redirect()
            ->route('products.show', $product)
            ->with('status', 'Terima kasih, ulasanmu sudah tersimpan.');
    }
}