<?php

namespace App\Services;

use App\Models\User;
use App\Models\UserReward;

class RewardService
{
    public static function giveStar(User $user, string $action, int $relatedId = null, string $relatedType = null): void
    {
        $query = UserReward::where('user_id', $user->id)->where('action', $action);

        if ($relatedId && $relatedType) {
            $query->where('related_id', $relatedId)->where('related_type', $relatedType);
        }

        if (!$query->exists()) {
            UserReward::create([
                'user_id' => $user->id,
                'action' => $action,
                'related_id' => $relatedId,
                'related_type' => $relatedType,
            ]);

            $user->increment('stars');
        }
    }

}
