<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Lesson;
use App\Models\Comment;

class AchievementTest extends TestCase
{
    //user is not present 
    public function test_user_doesnt_exist()
    {
        $response = $this->get("/users/0/achievements");

        $response->assertStatus(404);
    }
    //user is present without any activity
    public function test_user_exist_without_activity()
    {
        $user = User::factory()->create();
        
        $response = $this->get("/users/{$user->id}/achievements");

        $response->assertStatus(200);
    }
    //user is present with 13 comments but without lessons watched
    public function test_user_with_13_comments_and_no_lessons()
    {
        $user = User::factory()
        ->has(Comment::factory()->count(13))
        ->create();

        $response = $this->get("/users/{$user->id}/achievements");

        $response->assertStatus(200);
    }
    //user is present with 20 comments but without lessons watched
    public function test_user_with_20_comments_and_no_lessons()
    {
        $user = User::factory()
        ->has(Comment::factory()->count(20))
        ->create();

        $response = $this->get("/users/{$user->id}/achievements");

        $response->assertStatus(200);
    }
    //user is present with 21 comments but without lessons watched
    public function test_user_with_21_comments_and_no_lessons()
    {
        $user = User::factory()
        ->has(Comment::factory()->count(21))
        ->create();

        $response = $this->get("/users/{$user->id}/achievements");

        $response->assertStatus(200);
    }
    //user is present with no comments but 50 lessons watched
    public function test_user_with_no_comments_and_50_lessons()
    {
        $user = User::factory()
        ->hasAttached(
            Lesson::factory()->count(50),
            ["watched"=>1]
        )
        ->create();

        $response = $this->get("/users/{$user->id}/achievements");

        $response->assertStatus(200);
    }
    //user is present with no comments but 28 lessons watched
    public function test_user_with_no_comments_and_28_lessons()
    {
        $user = User::factory()
        ->hasAttached(
            Lesson::factory()->count(28),
            ["watched"=>1]
        )
        ->create();

        $response = $this->get("/users/{$user->id}/achievements");

        $response->assertStatus(200);
    }
    //user is present with no comments but 51 lessons watched
    public function test_user_with_no_comments_and_51_lessons()
    {
        $user = User::factory()
        ->hasAttached(
            Lesson::factory()->count(51),
            ["watched"=>1]
        )
        ->create();

        $response = $this->get("/users/{$user->id}/achievements");

        $response->assertStatus(200);
    }
    //user is present with 1 lesson watched and 1 comment written
    public function test_user_with_1_comment_and_1_lesson()
    {
        $user = User::factory()
        ->has(Comment::factory()->count(1))
        ->hasAttached(
            Lesson::factory()->count(1),
            ["watched"=>1]
        )
        ->create();

        $response = $this->get("/users/{$user->id}/achievements");

        $response->assertStatus(200);
    }
    //user is present with 20 comments and 50 videos watched
    public function test_user_with_20_comments_and_50_lessons()
    {
        $user = User::factory()
        ->has(Comment::factory()->count(20))
        ->hasAttached(
            Lesson::factory()->count(50),
            ["watched"=>1]
        )
        ->create();

        $response = $this->get("/users/{$user->id}/achievements");

        $response->assertStatus(200);
    }
    //user is present with 21 comments and 51 videos watched
    public function test_user_with_21_comments_and_51_lessons($value='')
    {
        $user = User::factory()
        ->has(Comment::factory()->count(21))
        ->hasAttached(
            Lesson::factory()->count(51),
            ["watched"=>1]
        )
        ->create();

        $response = $this->get("/users/{$user->id}/achievements");

        $response->assertStatus(200);
    }
    //user is present with 18 comments and 32 videos watched
    public function test_user_with_18_comments_and_32_lessons($value='')
    {
        $user = User::factory()
        ->has(Comment::factory()->count(18))
        ->hasAttached(
            Lesson::factory()->count(32),
            ["watched"=>1]
        )
        ->create();

        $response = $this->get("/users/{$user->id}/achievements");

        $response->assertStatus(200);
    }
}
