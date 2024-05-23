<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\project;
use App\Models\permission_type;
use App\Models\tools_type;
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
        try {
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
                    'name' => $roleName . ' User',
                    'email' => $roleName . '@example.com',
                    'password' => Hash::make('12345678'),
                ]);

                // Assign role to the user
                $user->assignRole($roleName);
            }

            $tools = ['PELINDUNG KEPALA','PELINDUNG MUKA','PELINDUNG TELINGA','PELINDUNG TANGAN','PELINDUNG KAKI','PELINDUNG DI KETINGGIAN','BAJU KERJA','PENJAGA KEBAKARAN','DETEKSI GAS BERBAHAYA','ALAT PEMADAM API','ALAT BANTU PERNAFASAN'];
            foreach ($tools as $tools_name) {
                // Create a user
                \App\Models\tools_type::create([
                    'tools_name' => $tools_name,
                ]);
            }

            $permissions = ['KERJA PANAS','RUANG TERBATAS','PENGECATAN','TES RADIOGRAFI','PENGANGKATAN','KETINGGIAN','PENYELAMAN','ISOLASI','PENGGALIAN','PEMBERSIHAN DG BAHAN KIMIA','PEMBERSIHAN TANKI & PIPA','PEKERJAAN LISTRIK','KERJA DINGIN','PEKERJAAN MEKANIK','PEKERJAAN PERANCAH'];
            foreach ($permissions as $permissions_name) {
                // Create a user
                \App\Models\permission_type::create([
                    'permission_name' => $permissions_name,
                ]);
            }
            foreach ($roles as $roleName) {
                \App\Models\ptw::create([
                    'project_id' => '1',
                    'level' => $roleName,
                    'status' => '',
                    'berlaku_dari' => '',
                    'berlaku_sampai' => '',
                    'manpower_qty' => '5',
                    'remark' => 'kerja bagai kuda',
                    'approved_by' => '',
                ]);
            }
            \App\Models\project::create([
                'project_name' => 'nguli',
            ]);
        } catch (Exception $e) {
            
        }
    }
}
