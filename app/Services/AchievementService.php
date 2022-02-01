<?php

namespace App\Services;

use App\Models\Comment;
use App\Models\Lesson;
use App\Models\User;

class AchievementService{

	static public function countCommentsWritten($user_id)
	{
		if (User::where('user_id', $user_id)->first() != null) {
			return Comment::where('user_id', $user_id)->count();
		}else{
			return "User doesn't exist!";
		}
	}

	static public function countLessonsWatched()
	{
		if (User::where('user_id', $user_id)->first() != null) {
			return User::where('id', $user_id)->withCount('watched')->first()->watched_count;
		}else{
			return "User doesn't exist!";
		}
	}

}