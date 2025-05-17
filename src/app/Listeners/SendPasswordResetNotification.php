<?php

namespace App\Listeners;

use App\Events\PasswordResetRequested;
use Illuminate\Support\Facades\Mail;
use App\Mail\PasswordResetMail;

class SendPasswordResetNotification
{
    public function handle(PasswordResetRequested $event)
    {
        Mail::to($event->email)
            ->send(new PasswordResetMail($event->token));
    }
}
