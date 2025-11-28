<?php

namespace App\Http\Controllers;

use App\Models\User;

class SellerController extends Controller
{
    public function show(User $user)
    {
        $user->load(['products.photos']);

        $products = $user->products;

        return view('shops.show', [
            'seller'   => $user,
            'products' => $products,
        ]);
    }
}
