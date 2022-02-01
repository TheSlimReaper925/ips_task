<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\BadgeUnlockedEvent;
use App\Services\AchievementService;
use App\Models\User;

class BadgeUnlockListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        if (isset($event->user)) {
            $user = $event->user;
        }else{
            $user = User::where('id', $event->comment->user_id)->first();
        }
        $total_achievements = AchievementService::countTotalAchievements($user->id);

        switch ($total_achievements) {
            case 0:
                event(new BadgeUnlockedEvent($user, "Begginer"));
                break;
            case 4:
                event(new BadgeUnlockedEvent($user, "Intermediate"));
                break;
            case 8:
                event(new BadgeUnlockedEvent($user, "Advanced"));
                break;
            case 10:
                event(new BadgeUnlockedEvent($user, "Master"));
                break;
        }
    }
}
