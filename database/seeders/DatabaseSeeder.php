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

            $permissions_tambahan_hot = ['BAHAN YANG MUDAH TERBAKAR SUDAH DISINGKIRKAN/DILINDUNGI/DIJAGA',
'TIDAK DITEMUI TABUNG GAS DI ATAS KAPAL',
'LOKASI KERJA DAN DAERAH SEKITARNYA SUDAH DIBASAHI',
'PIPA-PIPA ATAU PERALATAN LAINNYA TELAH DIISOLASI',
'PERALATAN TELAH DIISOLASI TERHADAP HUBUNGAN LISTRIK',
'PERALATAN LAS DAN POTONG DALAM KEADAAN LAIK PAKAI',
'TELAH DISEDIAKAN SLANG AIR (PENYIRAM) YANG SIAP PAKAI',
'TERSEDIA ALAT PEMADAM KEBAKARAN YANG SESUAI DENGAN JENIS KEBAKARAN',
'TERSEDIA VENTILASI YANG MEMADAI',
'TELAH DISIAGAKAN PERSONIL PEMADAM KEBAKARAN (SAT-PK)'];
            
            foreach ($permissions_tambahan_hot as $permissions_name) {
                \App\Models\permission_tambahan::create([
                    'permission_type_id' => 1,
                    'permission_name' => $permissions_name,
                ]);
            }

            $permissions_tambahan_confined = ['SUDAH DILAKUKAN PEMERIKSAAN GAS DENGAN GAS DETECTOR DENGAN OKSIGEN >21%;  H2S <5 ppm; CO <9 ppm',
'RUANGAN TELAH DIBERSIHKAN',
'TERSEDIA PENERANGAN YANG MEMADAI',
'TERSEDIA PERALATAN RESCUE DAN RESUSITASI',
'PIPA-PIPA ATAU PERALATAN LAINNYA TELAH DIISOLASI',
'TERDAPAT PERSONIL YANG BERSIAGA DISAMPING LUBANG MASUK',
'SISTEM KOMUNIKASI ANTARA PERSONIL DI DALAM DAN YANG SIAGA DILUAR TELAH DISETUJUI DAN DIPERIKSA',
'TELAH MEMAHAMI DAN MENYETUJUI PROSEDUR EMERGENCY',
'TERSEDIA SISTEM PENCATATAN TERHADAP PERSONIL YANG MASUK KE DALAM KOMPARTEMEN',
'TERSEDIA VENTILASI YANG MEMADAI',
'TELAH DISIAGAKAN ALAT PEMADAM DAN PERSONIL PEMADAM KEBAKARAN (SAT-PK)',
'SAYA SADAR BAHWA RUANGAN HARUS SEGERA DIKOSONGKAN SEGERA BILA TERJADI KEGAGALAN VENTILASI ATAU BILA HASIL PENGETESAN BERUBAH DARI KRITERIA YANG DITETAPKAN',
'DILAKUKAN PENGECEKAN GAS SELAMA DAN SETELAH PEKERJAAN BERLANGSUNG'];
            
            foreach ($permissions_tambahan_confined as $permissions_name) {
                \App\Models\permission_tambahan::create([
                    'permission_type_id' => 2,
                    'permission_name' => $permissions_name,
                ]);
            }

            $permissions_tambahan_excavation = ['PENGAMANAN DAERAH PENGGALIAN',
'ALAT PENGGALI TANGAN DISEDIAKAN',
'MENGIDENTIFIKASI POTENSI BAHAYA',
'ISOLASI PERALATAN LISTRIK'];
            
            foreach ($permissions_tambahan_excavation as $permissions_name) {
                \App\Models\permission_tambahan::create([
                    'permission_type_id' => 3,
                    'permission_name' => $permissions_name,
                ]);
            }

            $permissions_tambahan_cold = ['BAHAN YANG MUDAH TERBAKAR SUDAH DISINGKIRKAN/DILINDUNGI/DIJAGA',
'TIDAK DITEMUI TABUNG GAS DI ATAS KAPAL',
'LOKASI KERJA DAN DAERAH SEKITARNYA SUDAH DIBASAHI',
'PIPA-PIPA ATAU PERALATAN LAINNYA TELAH DIISOLASI',
'PERALATAN TELAH DIISOLASI TERHADAP HUBUNGAN LISTRIK',
'PERALATAN LAS DAN POTONG DALAM KEADAAN LAIK PAKAI',
'TELAH DISEDIAKAN SLANG AIR (PENYIRAM) YANG SIAP PAKAI',
'TERSEDIA ALAT PEMADAM KEBAKARAN YANG SESUAI DENGAN JENIS KEBAKARAN',
'TERSEDIA VENTILASI YANG MEMADAI',
'TELAH DISIAGAKAN PERSONIL PEMADAM KEBAKARAN (SAT-PK)'];
            
            foreach ($permissions_tambahan_cold as $permissions_name) {
                \App\Models\permission_tambahan::create([
                    'permission_type_id' => 4,
                    'permission_name' => $permissions_name,
                ]);
            }

            $permissions_tambahan_isolation = ['PERALATAN KERJA DAN PELINDUNG DIRI YANG DIPERSYARATKAN',
'PERALATAN LISTRIK TELAH DIISOLASI, DIBERI TANDA DAN KUNCI (LOTO)',
'DIPASANG RAMBU/PENGHALANG',
'DAERAH KERJA DILENGKAPI PENERANGAN DAN VENTILASI YANG MEMADAI'];
            
            foreach ($permissions_tambahan_isolation as $permissions_name) {
                \App\Models\permission_tambahan::create([
                    'permission_type_id' => 5,
                    'permission_name' => $permissions_name,
                ]);
            }

            $permissions_tambahan_ketinggian = ['PASTIKAN KONDISI PELAKSANA DALAM KEADAAN SEHAT','PASTIKAN HANDRAIL TELAH DIPASANG UNTUK MENCEGAH TERJATUH','PASTIKAN BAGIAN TERBUKA DARI PERANCAH DAN LANTAI KERJA TELAH DILINDUNGI/DITUTUP','PASTIKAN FULL BODY HARNESS DALAM KONDISI YANG BAIK','PASTIKAN PEKERJA TELAH MENGGUNAKAAN SEPATU KESELAMATAN DENGAN LAPISAN ANTI SLIP','PASTIKAN ORANG YANG BEKERJA DI KETINGGIAN TELAH MENGGUNAKAN SABUK PENGAMAN (FULL BODY HARNESS)','PASTIKAN PEKERJA TELAH DIBERIKAN INSTRUKSI CARA PENGIKATAN DAN PEMAKAIAN FULL BODY HARNESS YANG BENAR','PASTIKAN HOOK DAN KARABINER PADA FULL BODY HARNESS BERFUNGSI DENGAN BAIK (DAPAT MEMBUKA DAN MENGUNCI)'];
            
            foreach ($permissions_tambahan_ketinggian as $permissions_name) {
                \App\Models\permission_tambahan::create([
                    'permission_type_id' => 6,
                    'permission_name' => $permissions_name,
                ]);
            }

            $permissions_tambahan_radiografi = ['PERSONIL YANG BEKERJA DI DAERAH SEKITARNYA DIBERITAHU PEKERJAAN RADIOAKTIF AKAN DILAKUKAN','PAGAR/LAMPU KEDIP-KEDIP TERPASANG HINGGA BATAS DAERAH LARANGAN','SUMBER RADIOAKTIF TIDAK BOLEH DITINGGAL TANPA PENGAWASAN RADIOGRAFER','SUMBER RADIOAKTIF DISIMPAN DI TEMPAT PENYIMPANAN YANG DITENTUKAN BILA TIAK DIGUNAKAN'];
            
            foreach ($permissions_tambahan_radiografi as $permissions_name) {
                \App\Models\permission_tambahan::create([
                    'permission_type_id' => 7,
                    'permission_name' => $permissions_name,
                ]);
            }

            $work_location = ['Bengkel Fabrikasi & SSH' ,'Bengkel Sub Assembly' ,'Bengkel Assembly MPL' ,'Bengkel Assembly CBL' ,'Bengkel Las 1' ,'Bengkel Las 2' ,'Bengkel Erection 1' ,'Bengkel Erection 2' ,'Bengkel Block Blasting Shop ' ,'Bengkel Konstruksi Plat 1' ,'Bengkel Konstriksi Plat 2' ,'Bengkel Pipa' ,'Bengkel CNC' ,'Bengkel Machinery Assembly' ,'Bengkel Machinery Outfitting' ,'Bengkel Listrik' ,'Bengkel Kayu' ,'Dock Semarang' ,'Dock Irian' ,'Dock Surabaya' ,'Dock Pare-Pare'];
            foreach ($work_location as $work_locations) {
                \App\Models\work_location::create([
                    'location_name' => $work_locations,
                ]);
            }

            $project = [
                'project_code' => ['BMPP-2', 'BMPP-3', 'SPM', 'METSO', 'DLU', 'BRS', 'FMP', 'LPD'],
                'project_name' => ['Barge Mounted Power Plant 2', 'Barge Mounted Power Plant 3', 'Single Point Mooring', 'Metso Outotec', 'Dharma Lautan Utama', 'Kapal Bantu Rumah Sakit', 'Kapal Fregat Merah Putih', 'Kapal Landing Platform Dock']
            ];
            for ($aa=0; $aa < count($project['project_code']); $aa++) { 
                \App\Models\project::create([
                    'project_code' => $project['project_code'][$aa],
                    'project_name' => $project['project_name'][$aa],
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

            $jsa_user = ['pelaksana', 'penyusun'];
            $judul = ['pengelasan pipa air', 'pengeboran ground dekat plant X'];
            $uraian = ['pipa bocor tersenggol alat berat', 'meratakan tanah'];
            $nama_jsa_user = ['bambang', 'michel', 'veronica', 'samsudin', 'akbar'];
            $num = [1,2,3,4,5,6,7,8,9,10,11,12];
            for ($cc=0; $cc < 2; $cc++) { 
                for ($c=0; $c < 6; $c++) { 
                    \App\Models\jsa::create([
                        'ptw_id' => $num[($cc == 1) ? $c : $c+6],
                        'supervisi_name' => 'spv User',
                        'project_code' => $project['project_code'][$c],
                        'judul_pekerjaan' => $judul[$cc],
                        'tempat_bekerja' => $work_location[$cc],
                        'uraian_tugas' => $uraian[$cc],
                        'plant_loc' => '??',
                        'review' => '',
                        'reviewed_by' => '',
                        'reviewed_date' => ''
                    ]);
                }

                for ($cccc=0; $cccc < 2; $cccc++) { 
                    for ($ccc=0; $ccc < 4; $ccc++) { 
                        \App\Models\user_jsa::create([
                            'jsa_id' => $cc+1,
                            'jenis' => $jsa_user[$cccc],
                            'nama' => $nama_jsa_user[$ccc]
                        ]);
                    }
                }
            }
            
        } catch (Exception $e) {
            
        }
    }
}
