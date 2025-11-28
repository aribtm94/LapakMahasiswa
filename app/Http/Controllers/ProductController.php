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

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'        => 'required|string|max:255',
            'category'    => 'required|string|in:elektronik,fashion,makanan,akademik,rumahan',
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