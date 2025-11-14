<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SellerApprovedMail extends Mailable
{
    use Queueable, SerializesModels;

    public User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function build()
    {
        $activationUrl = url('/seller/activate/' . $this->user->activation_token);
        return $this->subject('Akun Penjual Disetujui')
            ->view('emails.seller.approved')
            ->with([
                'user' => $this->user,
                'activationUrl' => $activationUrl,
            ]);
    }
}
