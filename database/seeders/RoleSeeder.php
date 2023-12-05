<?php

namespace Database\Seeders;

use App\Enum\UserRolesEnum;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['name' => UserRolesEnum::ADMIN]);
        Role::create(['name' => UserRolesEnum::AUTHOR]);
        Role::create(['name' => UserRolesEnum::READER]);
    }
}
