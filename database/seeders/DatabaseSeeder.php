<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $roles = ['admin', 'hse', 'kabeng', 'kapro', 'spv', 'karyawan'];

        foreach ($roles as $roleName) {
            $role = Role::create(['name' => $roleName]);
            $permission = Permission::create(['name' => $roleName]);
            $role->givePermissionTo($permission);
        }

        // User::factory(10)->create();

        foreach ($roles as $roleName) {
            // Create a user
            $user = User::factory()->create([
                'name' => ucfirst($roleName) . ' User',
                'email' => $roleName . '@example.com',
                'password' => Hash::make('12345678'),
            ]);

            // Assign role to the user
            $user->assignRole($roleName);
        }
    }
}
