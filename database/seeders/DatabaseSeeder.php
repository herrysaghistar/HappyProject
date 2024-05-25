<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\project;
use App\Models\permission_type;
use App\Models\tools_type;
use App\Models\work_location;
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
            $roles = ['hse', 'kabeng', 'kapro', 'spv', 'admin'];

            foreach ($roles as $roleName) {
                $role = Role::create(['name' => $roleName]);
                $permission = Permission::create(['name' => $roleName]);
                $role->givePermissionTo($permission);
            }

            // User::factory(10)->create();

            foreach ($roles as $roleName) {
                $user = User::factory()->create([
                    'name' => $roleName . ' User',
                    'email' => $roleName . '@example.com',
                    'password' => Hash::make('12345678'),
                ]);

                $user->assignRole($roleName);
            }

            $tools = ['PELINDUNG KEPALA','PELINDUNG MUKA','PELINDUNG TELINGA','PELINDUNG TANGAN','PELINDUNG KAKI','PELINDUNG DI KETINGGIAN','BAJU KERJA','PENJAGA KEBAKARAN','DETEKSI GAS BERBAHAYA','ALAT PEMADAM API','ALAT BANTU PERNAFASAN'];
            foreach ($tools as $tools_name) {
                \App\Models\tools_type::create([
                    'tools_name' => $tools_name,
                ]);
            }

            $permissions = ['KERJA PANAS','RUANG TERBATAS','PENGECATAN','TES RADIOGRAFI','PENGANGKATAN','KETINGGIAN','PENYELAMAN','ISOLASI','PENGGALIAN','PEMBERSIHAN DG BAHAN KIMIA','PEMBERSIHAN TANKI & PIPA','PEKERJAAN LISTRIK','KERJA DINGIN','PEKERJAAN MEKANIK','PEKERJAAN PERANCAH'];
            foreach ($permissions as $permissions_name) {
                \App\Models\permission_type::create([
                    'permission_name' => $permissions_name,
                ]);
            }

            $work_location = ['Bengkel Fabrikasi & SSH' ,'Bengkel Sub Assembly' ,'Bengkel Assembly MPL' ,'Bengkel Assembly CBL' ,'Bengkel Las 1' ,'Bengkel Las 2' ,'Bengkel Erection 1' ,'Bengkel Erection 2' ,'Bengkel Block Blasting Shop ' ,'Bengkel Konstruksi Plat 1' ,'Bengkel Konstriksi Plat 2' ,'Bengkel Pipa' ,'Bengkel CNC' ,'Bengkel Machinery Assembly' ,'Bengkel Machinery Outfitting' ,'Bengkel Listrik' ,'Bengkel Kayu' ,'Dock Semarang' ,'Dock Irian' ,'Dock Surabaya' ,'Dock Pare-Pare'];
            foreach ($work_location as $work_locations) {
                \App\Models\work_location::create([
                    'location_name' => $work_locations,
                ]);
            }

            $project = ['nguli', 'nge cor', 'malu', 'nempa', 'ngelebur', 'mecah batu', 'pembersihan' ,'pengelasan' ,'isolasi'];
            foreach ($project as $projects) {
                \App\Models\project::create([
                    'project_name' => $projects,
                ]);
            }

            $j = 1;
            $roles_ptw = ['hse', 'kabeng', 'kapro'];
            for ($i=0; $i < 3; $i++) { 
                foreach ($roles_ptw as $roleName) {
                \App\Models\ptw::create([
                    'project_id' => $j,
                    'work_location_id' => $j,
                    'level' => $roleName,
                    'status' => '',
                    'berlaku_dari' => '2024-05-25',
                    'berlaku_sampai' => '2024-05-30',
                    'manpower_qty' => '5',
                    'remark' => 'kerja bolo',
                    'instruksi_tambahan' => 'kerja bagai kuda',
                    'approved_by' => '',
                    'rejected_by' => '',
                    'created_by' => $roleName . ' User',
                ]);
                $j++;
                }
            }
        } catch (Exception $e) {
            
        }
    }
}
