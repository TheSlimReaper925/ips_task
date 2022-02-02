<?php

namespace App\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class BadgeUnlockedEvent
{
    use Dispatchable, SerializesModels;

    public $user;
    public $badge_name;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user, $badge_name)
    {
        $this->user = $user;
        $this->badge_name = $badge_name;
    }

}
