<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\RoleEnum;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(
            [
                RoleSeeder::class,
                CategorySeeder::class,
                QuizSeeder::class,
                QuestionSeeder::class
            ]);

      //   User::factory(3)->create();

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('12345678'),
        ])->assignRole([RoleEnum::ADMIN]);
        //syncRoles('user');  // assignRole yerinə syncRoles istifadə olunur ki, yalnız bir rol təyin edilsin

        User::factory()->create([
            'name' => 'User',
            'email' => 'user@user.com',
            'password' => bcrypt('12345678'),
        ])->assignRole([RoleEnum::USER]);


    }
}
