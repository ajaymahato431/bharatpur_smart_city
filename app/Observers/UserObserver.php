<?php

namespace App\Observers;

use App\Mail\EmailNotification;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserObserver
{
    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        //
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        if ($user->isDirty('status') && $user->status == 'approved') {
            $password = rand(11111, 99999);

            $user->withoutEvents(function () use ($user, $password) {
                $user->password = Hash::make($password);
                $user->update();
            });

            $data = [
                "name" => $user->name,
                "subject" => "User Registration Approved",
                "message" => "Your registration request to SmartWada has been approved. Your Login Credentials are Email: $user->email and Password: $password",
            ];

            Mail::to($user->email)->send(new EmailNotification($data));
        }
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        //
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user): void
    {
        //
    }
}
