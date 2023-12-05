<?php

namespace Database\Seeders;

use App\Enum\UserRolesEnum;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->count(30)->create()->each(function (User $item) {
            $item->assignRole(UserRolesEnum::READER);
        });
        User::factory()->count(10)->create()->each(function (User $item) {
            $item->assignRole(UserRolesEnum::AUTHOR);
        });

    }
}
