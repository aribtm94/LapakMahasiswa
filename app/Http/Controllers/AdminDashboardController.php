<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\ProductGuestReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Dashboard utama dengan grafis statistik
     */
    public function index()
    {
        // Check if user is admin
        if (!auth()->user()->is_admin) {
            abort(403, 'Unauthorized');
        }

        // 1. Sebaran jumlah produk berdasarkan kategori
        $productsByCategory = Product::select('category', DB::raw('count(*) as total'))
            ->groupBy('category')
            ->orderByDesc('total')
            ->get();

        // 2. Sebaran jumlah toko berdasarkan lokasi provinsi (exclude admin)
        $shopsByProvince = User::select('provinsi', DB::raw('count(*) as total'))
            ->whereNotNull('seller_status')
            ->where('seller_status', 'approved')
            ->whereNotNull('provinsi')
            ->where(function($q) { $q->where('is_admin', false)->orWhereNull('is_admin'); })
            ->groupBy('provinsi')
            ->orderByDesc('total')
            ->get();

        // 3. Jumlah user penjual aktif dan tidak aktif (exclude admin)
        $notAdmin = function($q) { $q->where('is_admin', false)->orWhereNull('is_admin'); };
        $activeSellers = User::where('seller_status', 'approved')->where($notAdmin)->count();
        $inactiveSellers = User::where(function($q) use ($notAdmin) {
                $q->whereIn('seller_status', ['pending', 'rejected'])
                  ->orWhere(function($query) {
                      $query->whereNull('seller_status')
                            ->whereNotNull('shop_name');
                  });
            })->where($notAdmin)->count();
        $pendingSellers = User::where('seller_status', 'pending')->where($notAdmin)->count();
        $rejectedSellers = User::where('seller_status', 'rejected')->where($notAdmin)->count();

        // 4. Jumlah pengunjung yang memberikan komentar dan rating
        $totalReviews = ProductGuestReview::count();
        $uniqueReviewers = ProductGuestReview::distinct('email')->count('email');
        
        // Rating distribution
        $ratingDistribution = ProductGuestReview::select('rating', DB::raw('count(*) as total'))
            ->groupBy('rating')
            ->orderBy('rating')
            ->get()
            ->pluck('total', 'rating')
            ->toArray();

        // Fill missing ratings with 0
        for ($i = 1; $i <= 5; $i++) {
            if (!isset($ratingDistribution[$i])) {
                $ratingDistribution[$i] = 0;
            }
        }
        ksort($ratingDistribution);

        // Additional stats
        $totalProducts = Product::count();
        $totalUsers = User::count();
        $averageRating = ProductGuestReview::avg('rating') ?? 0;

        return view('admin.dashboard.index', compact(
            'productsByCategory',
            'shopsByProvince',
            'activeSellers',
            'inactiveSellers',
            'pendingSellers',
            'rejectedSellers',
            'totalReviews',
            'uniqueReviewers',
            'ratingDistribution',
            'totalProducts',
            'totalUsers',
            'averageRating'
        ));
    }

    /**
     * API endpoint untuk data chart (optional AJAX)
     */
    public function getChartData(Request $request)
    {
        if (!auth()->user()->is_admin) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $type = $request->get('type');

        switch ($type) {
            case 'products-category':
                $data = Product::select('category', DB::raw('count(*) as total'))
                    ->groupBy('category')
                    ->orderByDesc('total')
                    ->get();
                break;

            case 'shops-province':
                $data = User::select('provinsi as label', DB::raw('count(*) as total'))
                    ->where('seller_status', 'approved')
                    ->whereNotNull('provinsi')
                    ->where(function($q) { $q->where('is_admin', false)->orWhereNull('is_admin'); })
                    ->groupBy('provinsi')
                    ->orderByDesc('total')
                    ->get();
                break;

            case 'sellers-status':
                $notAdmin = function($q) { $q->where('is_admin', false)->orWhereNull('is_admin'); };
                $data = [
                    ['status' => 'Aktif', 'total' => User::where('seller_status', 'approved')->where($notAdmin)->count()],
                    ['status' => 'Pending', 'total' => User::where('seller_status', 'pending')->where($notAdmin)->count()],
                    ['status' => 'Ditolak', 'total' => User::where('seller_status', 'rejected')->where($notAdmin)->count()],
                ];
                break;

            case 'ratings':
                $data = ProductGuestReview::select('rating', DB::raw('count(*) as total'))
                    ->groupBy('rating')
                    ->orderBy('rating')
                    ->get();
                break;

            default:
                $data = [];
        }

        return response()->json($data);
    }
}
