<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\project;
use App\Models\permission_type;
use App\Models\permission_tambahan;
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

            $permissions = ['KERJA PANAS / HOT WORK','RUANG TERBATAS / CONFINED SPACE','PENGGALIAN / EXCAVATION','PEKERJAAN DINGIN / COLD WORK','ISOLASI/LOTO / ISOLATION','KERJA DI KETINGGIAN / WORKING AT HEIGHT','TES RADIOGRAFI / X-RAY'];
            foreach ($permissions as $permissions_name) {
                \App\Models\permission_type::create([
                    'permission_name' => $permissions_name,
                ]);
            }

            $tools = ['PELINDUNG KEPALA / HELM PROTECTION','PELINDUNG MUKA / FACESHIELD, EYE PROTECTION','PELINDUNG TELINGA / EAR PROTECTION','PELINDUNG TANGAN / SAFETY GLOVES','PELINDUNG KAKI / SAFETY SHOES','PELINDUNG DI KETINGGIAN / FULL BODY HARNESS','BAJU KERJA / WEARPCAK CATTLEPAK','PENJAGA KEBAKARAN / FIRE WATCHER','DETEKSI GAS BERBAHAYA / GAS DETECTION TEST','ALAT PEMADAM API / FIRE EXTINGUISHER','ALAT BANTU PERNAPASAN / BREATHING APPARATUS','LAINNYA / OTHERS'];
            for ($y=1; $y <= count($permissions) ; $y++) { 
                foreach ($tools as $tools_name) {
                    \App\Models\tools_type::create([
                        'permission_type_id' => $y,
                        'tools_name' => $tools_name,
                    ]);
                }
            }

            $permissions_tambahan = ['PERSONIL YANG BEKERJA DI DAERAH SEKITARNYA DIBERITAHU PEKERJAAN RADIOAKTIF AKAN DILAKUKAN', 'PAGAR/LAMPU KEDIP-KEDIP TERPASANG HINGGA BATAS DAERAH LARANGAN', 'SUMBER RADIOAKTIF TIDAK BOLEH DITINGGAL TANPA PENGAWASAN RADIOGRAFER', 'SUMBER RADIOAKTIF DISIMPAN DI TEMPAT PENYIMPANAN YANG DITENTUKAN BILA TIAK DIGUNAKAN'];
            
            for ($x=1; $x <= count($permissions); $x++) { 
                foreach ($permissions_tambahan as $permissions_name) {
                    \App\Models\permission_tambahan::create([
                        'permission_type_id' => $x,
                        'permission_name' => $permissions_name,
                    ]);
                }
            }

            $work_location = ['Bengkel Fabrikasi & SSH' ,'Bengkel Sub Assembly' ,'Bengkel Assembly MPL' ,'Bengkel Assembly CBL' ,'Bengkel Las 1' ,'Bengkel Las 2' ,'Bengkel Erection 1' ,'Bengkel Erection 2' ,'Bengkel Block Blasting Shop ' ,'Bengkel Konstruksi Plat 1' ,'Bengkel Konstriksi Plat 2' ,'Bengkel Pipa' ,'Bengkel CNC' ,'Bengkel Machinery Assembly' ,'Bengkel Machinery Outfitting' ,'Bengkel Listrik' ,'Bengkel Kayu' ,'Dock Semarang' ,'Dock Irian' ,'Dock Surabaya' ,'Dock Pare-Pare'];
            foreach ($work_location as $work_locations) {
                \App\Models\work_location::create([
                    'location_name' => $work_locations,
                ]);
            }

            $project = ['Barge Mounted Power Plant 2 (BMPP-2)', 'Barge Mounted Power Plant 3 (BMPP-3)', 'Single Point Mooring (SPM)', 'Metso Outotec (METSO)', 'Dharma Lautan Utama (DLU)', 'Kapal Bantu Rumah Sakit (BRS)', 'Kapal Fregat Merah Putih (FMP)', 'Kapal Landing Platform Dock (LPD)'];
            foreach ($project as $projects) {
                \App\Models\project::create([
                    'project_name' => $projects,
                ]);
            }

            $roles_ptw = ['hse', 'kabeng', 'kapro'];
            for ($i=0; $i < 5; $i++) { 
                foreach ($roles_ptw as $roleName) {
                \App\Models\ptw::create([
                    'project_id' => $i+1    ,
                    'permission_id' => $i+1 ,
                    'work_location_id' => $i+1  ,
                    'level' => $roleName,
                    'berlaku_dari' => '2024-05-25',
                    'berlaku_sampai' => '2024-05-30',
                    'manpower_qty' => '5',
                    'remark' => 'kerja bolo',
                    'status' => '',
                    'approved_by' => '',
                    'rejected_by' => '',
                    'created_by' => $roleName . ' User',
                ]);

                }
            }
        } catch (Exception $e) {
            
        }
    }
}
