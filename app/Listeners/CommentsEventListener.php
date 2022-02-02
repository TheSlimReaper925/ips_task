<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Services\AchievementService;
use App\Events\AchievementUnlockedEvent;
use App\Models\User;

class CommentsEventListener
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
        $count = AchievementService::countCommentsWritten($event->comment->user_id);
        $user = User::where('id', $event->comment->user_id)->first();
        switch ($count) {
            case 1:
                event(new AchievementUnlockedEvent($user, "First Comment Written"));
                break;
            case 3:
                event(new AchievementUnlockedEvent($user, "3 Comments Written"));
                break;
            case 5:
                event(new AchievementUnlockedEvent($user, "5 Comments Written"));
                break;
            case 10:
                event(new AchievementUnlockedEvent($user, "10 Comments Written"));
                break;
            case 20:
                event(new AchievementUnlockedEvent($user, "20 Comments Written"));
                break;
        }
    }
}
