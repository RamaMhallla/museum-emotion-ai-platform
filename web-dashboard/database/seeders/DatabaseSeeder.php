<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(PermissionSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(EmotionSeeder::class);

        $user = User::UpdateOrCreate(
            ['id' => 1],
            [
                'name' => 'Superadmin',
                'email' => 'superadmin@admin.com',
                'password' => Hash::make('12345678'),
            ]
        );
        $user = User::UpdateOrCreate(
            ['id' => 4],
            [
                'name' => 'Visitor',

            ]
        );

        $user->assignRole('superadmin');

        $category = Category::UpdateOrCreate(
            ['id' => 1],
            [
                'name' => 'Artwork',
                'name_it' => 'Opera d\'arte'
            ]
        );
    }
}