<?php

namespace Database\Factories;

use App\Enum\UserRolesEnum;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {


        return [
            'title' => fake()->text(rand(10, 50)),
            'text' => fake()->text(rand(1000, 2000)),
            'image' => null,
            'time_reading' => rand(10, 30),
            'user_id'   => User::all()->filter(function (User $item) {
                return $item->hasRole(UserRolesEnum::AUTHOR);
            })->random()->id,
        ];
    }
}
