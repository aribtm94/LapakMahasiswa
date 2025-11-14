<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class SellerActivationController extends Controller
{
    public function activate(string $token)
    {
        $user = User::where('activation_token', $token)->where('seller_status', 'approved')->first();
        if (!$user) {
            return redirect('/')->with('error', 'Token aktivasi tidak valid.');
        }
        $user->activation_token = null;
        if (!$user->email_verified_at) {
            $user->email_verified_at = now();
        }
        $user->save();

        Auth::login($user);
        return redirect('/')->with('status', 'Akun penjual aktif. Selamat datang!');
    }
}
