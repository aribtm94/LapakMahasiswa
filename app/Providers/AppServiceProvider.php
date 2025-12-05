<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\User;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Share pending seller count with admin layout (exclude admin)
        View::composer('layouts.admin', function ($view) {
            $pendingCount = User::where('seller_status', 'pending')
                                ->whereNotNull('shop_name')
                                ->where(function($q) { $q->where('is_admin', false)->orWhereNull('is_admin'); })
                                ->count();
            $view->with('pendingCount', $pendingCount);
        });
    }
}
