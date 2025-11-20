<?php

namespace App\Observers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserObserver
{
    /**
     * Handle the User "creating" event.
     * 
     * Memastikan password di-hash sebelum disimpan
     */
    public function creating(User $user): void
    {
        // Jika password belum ter-hash, hash sekarang
        if ($user->kata_sandi && !str_starts_with($user->kata_sandi, '$2')) {
            $user->kata_sandi = Hash::make($user->kata_sandi);
        }
    }

    /**
     * Handle the User "updating" event.
     * 
     * Jika password di-update, pastikan ter-hash
     */
    public function updating(User $user): void
    {
        // Cek jika kata_sandi berubah
        if ($user->isDirty('kata_sandi')) {
            $newPassword = $user->getAttribute('kata_sandi');
            // Jika password belum ter-hash, hash sekarang
            if ($newPassword && !str_starts_with($newPassword, '$2')) {
                $user->kata_sandi = Hash::make($newPassword);
            }
        }
    }
}
