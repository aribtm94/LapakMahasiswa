<?php

namespace App\Http\Controllers;

use App\Mail\SellerApprovedMail;
use App\Mail\SellerRejectedMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AdminSellerVerificationController extends Controller
{
    public function index()
    {
        $pending = User::where('seller_status', 'pending')->get();
        $approved = User::where('seller_status', 'approved')->get();
        $rejected = User::where('seller_status', 'rejected')->get();
        return view('admin.sellers.index', compact('pending', 'approved', 'rejected'));
    }

    public function show(User $user)
    {
        return view('admin.sellers.show', compact('user'));
    }

    public function approve(User $user)
    {
        if ($user->seller_status !== 'pending') {
            return redirect()->back()->with('error', 'Status bukan pending');
        }

        $token = Str::random(64);
        $user->update([
            'seller_status' => 'approved',
            'activation_token' => $token,
            'rejection_reason' => null,
        ]);

        Mail::to($user->email)->send(new SellerApprovedMail($user));

        return redirect()->route('admin.sellers.index')->with('status', 'Penjual disetujui & email dikirim.');
    }

    public function reject(User $user, Request $request)
    {
        if ($user->seller_status !== 'pending') {
            return redirect()->back()->with('error', 'Status bukan pending');
        }
        $data = $request->validate([
            'reason' => 'required|string|max:500',
        ]);
        $user->update([
            'seller_status' => 'rejected',
            'rejection_reason' => $data['reason'],
            'activation_token' => null,
        ]);

        Mail::to($user->email)->send(new SellerRejectedMail($user));

        return redirect()->route('admin.sellers.index')->with('status', 'Penjual ditolak & email dikirim.');
    }
}
