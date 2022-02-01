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

	static public function countCommentsAchievements($user_id)
	{
		if (User::where('user_id', $user_id)->first() != null) {
			$count = Comment::where('user_id', $user_id)->count();
			//counting achievements based on how many comment user has written
			switch (true) {
				case ($count == 0):
					return 0;
					break;
				case ($count > 0 && $count < 3):
					return 1;
					break;
				case ($count >= 3 && $count < 5):
					return 2;
					break;
				case ($count >= 5 && $count < 10):
					return 3;
					break;
				case ($count >= 10 && $count < 20):
					return 4;
					break;
				case ($count >= 20):
					return 5;
					break;				
			}
		}else{
			return "User doesn't exist!";
		}
	}

	static public function countLessonsWatchedAchievements($user_id)
	{
		if (User::where('user_id', $user_id)->first() != null) {
			$count = User::where('id', $user_id)->withCount('watched')->first()->watched_count;
			//counting achievements based on how many lessons user has watched
			switch (true) {
				case ($count == 0):
					return 0;
					break;
				case ($count > 0 && $count < 5):
					return 1;
					break;
				case ($count >= 5 && $count < 10):
					return 2;
					break;
				case ($count >= 10 && $count < 25):
					return 3;
					break;
				case ($count >= 25 && $count < 50):
					return 4;
					break;
				case ($count >= 50):
					return 5;
					break;				
			}
		}else{
			return "User doesn't exist!";
		}
	}

	static public function countTotalAchievements($user_id)
	{
		return (AchievementService::countCommentsAchievements($user_id) + AchievementService::countLessonsWatchedAchievements($user_id));
	}

}