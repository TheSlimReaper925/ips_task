<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Services\AchievementService;
use App\Events\AchievementUnlockedEvent;

class LessonWatchedEventListener
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
        $count = AchievementService::countLessonsWatched($event->user->id);
        switch ($count) {
            case 1:
                event(new AchievementUnlockedEvent($event->user, "First Lesson Watched"));
                break;
            case 5:
                event(new AchievementUnlockedEvent($event->user, "5 Lessons Watched"));
                break;
            case 10:
                event(new AchievementUnlockedEvent($event->user, "10 Lessons Watched"));
                break;
            case 25:
                event(new AchievementUnlockedEvent($event->user, "25 Lessons Watched"));
                break;
            case 50:
                event(new AchievementUnlockedEvent($event->user, "50 Lessons Watched"));
                break;
        }
    }
}
