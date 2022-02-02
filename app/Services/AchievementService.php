<?php

namespace App\Services;

use App\Models\Comment;
use App\Models\Lesson;
use App\Models\User;
use App\Constants\Unlockables;

class AchievementService{

	static public function countCommentsWritten($user_id)
	{
		if (User::where('id', $user_id)->first() != null) {
			return Comment::where('user_id', $user_id)->count();
		}else{
			return "User doesn't exist!";
		}
	}

	static public function countLessonsWatched($user_id)
	{
		if (User::where('id', $user_id)->first() != null) {
			return User::where('id', $user_id)->withCount('watched')->first()->watched_count;
		}else{
			return "User doesn't exist!";
		}
	}

	static public function countCommentsAchievements($user_id)
	{
		if (User::where('id', $user_id)->first() != null) {
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
		if (User::where('id', $user_id)->first() != null) {
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

	static public function badgeIndex($user_id)
	{
		$achievements = AchievementService::countTotalAchievements($user_id);
		switch (true) {
			case ($achievements >=0 && $achievements < 4):
				return 0;
				break;
			case ($achievements >= 4 && $achievements < 8):
				return 1;
				break;
			case ($achievements >= 8 && $achievements < 10):
				return 2;
				break;
			case ($achievements == 10):
				return 3;
				break;	
		}
	}

	static public function unlockedAchievements($user_id)
	{
		$commentAchievements = Unlockables::CommentAchievements;
		$lessonAchievements = Unlockables::LessonAchievements;
		$comments = array_splice($commentAchievements, 0, AchievementService::countCommentsAchievements($user_id));
		$lessons = array_splice($lessonAchievements, 0, AchievementService::countLessonsWatchedAchievements($user_id));
		$result = array_merge($comments, $lessons);
		return $result;
	}

	static public function netxAvailableAchievements($user_id)
	{
		$commentAchievements = Unlockables::CommentAchievements;
		$lessonAchievements = Unlockables::LessonAchievements;
		$mergedAchievements = array_merge($commentAchievements, $lessonAchievements);
		return array_values(array_diff($mergedAchievements, AchievementService::unlockedAchievements($user_id)));
	}

	static public function remainingForNextAchievements($user_id, $index)
	{
		$next_badge = isset(Unlockables::Milestones[$index + 1]) ? Unlockables::Milestones[$index + 1] : 10;
		$current_achievements = AchievementService::countTotalAchievements($user_id);

		return $next_badge - $current_achievements;
	}

}
