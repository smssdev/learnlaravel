<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ImageFactory extends Factory
{
    public function definition(): array
    {
        return [
            // 'url' => 'images/' . $this->faker->image('public/storage/images', 640, 480, null, false),
            // 'url' => $this->faker->imageUrl(),
            'url' => 'https://picsum.photos/200/300', // صورة افتراضية
        ];
    }
}
