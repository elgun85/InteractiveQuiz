<?php

namespace Database\Seeders;

use App\RoleEnum;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{   public function run(): void
    {
        Role::create(['name' => RoleEnum::ADMIN->value]);
        Role::create(['name' => RoleEnum::USER->value]);
    }
}
