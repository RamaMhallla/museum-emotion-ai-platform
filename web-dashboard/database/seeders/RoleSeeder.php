<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            ['id' => 1, 'name' => 'superadmin'],
            ['id' => 2, 'name' => 'admin'],
            ['id' => 3, 'name' => 'user'],
        ];

        foreach ($roles as $roleData) {
            $role = Role::updateOrCreate(
                ['id' => $roleData['id']],
                $roleData
            );

            if ($role->name === 'superadmin') {
                $role->syncPermissions(Permission::all());
            }
        }
    }
}
