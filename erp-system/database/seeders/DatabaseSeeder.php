<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Models\Post;
use App\Models\Profile;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // إنشاء Tags عامة
        $tags = Tag::factory()->count(10)->create();

        User::factory()
            ->count(10)
            ->create()
            ->each(function ($user) use ($tags) {
                // علاقة 1:1 - Profile
                $user->profile()->create(Profile::factory()->make()->toArray());

                // علاقة 1:N - Posts
                $posts = Post::factory()->count(3)->make();
                $user->posts()->saveMany($posts);

                // لكل بوست: علاقات Tags + Images
                foreach ($user->posts as $post) {
                    $post->tags()->attach($tags->random(2));
                    $post->images()->create(Image::factory()->make()->toArray());
                }

                // صورة للمستخدم (Polymorphic)
                $user->images()->create(Image::factory()->make()->toArray());
            });
    }
}
