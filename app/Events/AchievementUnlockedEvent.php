<?php

namespace App\Events;

use App\Models\User;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AchievementUnlockedEvent
{
    use Dispatchable, SerializesModels;

    public $user;
    public $achievement_name;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user, $achievement_name)
    {
        $this->user = $user;
        $this->achievement_name = $achievement_name;
    }

}
