<?php

namespace Database\Seeders;

use App\Enum\UserRolesEnum;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'email' => 'admin@admin',
            'name' => 'admin',
            'password' => Hash::make('123'),
        ])->assignRole(UserRolesEnum::ADMIN);
    }
}
