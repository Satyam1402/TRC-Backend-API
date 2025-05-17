<?php

namespace App\Services;

use App\Models\User;
use App\Models\UserReward;

class RewardService
{
    public static function giveStar(User $user, string $action): void
    {
        // Prevent duplicate reward
        if (!UserReward::where('user_id', $user->id)->where('action', $action)->exists()) {
            UserReward::create([
                'user_id' => $user->id,
                'action' => $action,
            ]);

            $user->increment('stars');
        }
    }
}
