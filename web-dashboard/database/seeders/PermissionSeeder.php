<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            ['id' => 1, 'name' => 'Manage Users'],
            ['id' => 2, 'name' => 'Manage Artworks'],
            ['id' => 3, 'name' => 'Manage Category'],
            ['id' => 4, 'name' => 'Manage Reports'],
            ['id' => 5, 'name' => 'Manage Emotions'],
        ];
        
        foreach ($permissions as $permission) {
            Permission::updateOrCreate(
                ['id' => $permission['id']], 
                ['name' => $permission['name']]
            );
        }
    }
}
