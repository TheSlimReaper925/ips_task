<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\AchievementService;
use Illuminate\Http\Request;
use App\Events\CommentWritten;
use App\Models\Comment;
use App\Constants\Unlockables;

class AchievementsController extends Controller
{
    public function index(User $user)
    {
        $badge_index = AchievementService::badgeIndex($user->id);
        return response()->json([
            'unlocked_achievements' => AchievementService::unlockedAchievements($user->id),
            'next_available_achievements' => AchievementService::netxAvailableAchievements($user->id),
            'current_badge' => Unlockables::Badges[$badge_index],
            'next_badge' => isset(Unlockables::Badges[$badge_index + 1]) ? Unlockables::Badges[$badge_index + 1] : "",
            'remaing_to_unlock_next_badge' => AchievementService::remainingForNextAchievements($user->id, $badge_index)
        ]);
    }
}
