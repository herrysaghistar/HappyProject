<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ptw;
use App\Models\jsa;
use App\Models\work_location;
use App\Models\project;
use App\Models\ptw_tools;
use App\Models\ptw_permission;
use App\Models\tools_type;
use App\Models\user_jsa;
use App\Models\permission_tambahan;
use App\Models\User;
use App\Models\LK;
use App\Models\PB;
use App\Models\PPE;
use App\Models\Person;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use \PDF;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $ptw = ptw::count();
        $ptw_undone = ptw::where('level','<>','approved')->count();
        $jsa = jsa::count();
        $jsa_undone = jsa::where('reviewed_by', '=', '')->count();
        $document_count = [
            'ptw' => $ptw,
            'ptw_undone' => $ptw_undone,
            'jsa' => $jsa,
            'jsa_undone' => $jsa_undone
        ];
        return view('dashboard.index', compact('document_count'));
    }

    public function create(Request $request)
    {
        $ptw = New ptw;
        $ptw->project_id = $request->project_id;
        $ptw->permission_id = $request->permission_id;
        $ptw->work_location_id = $request->location_id;
        $ptw->level = 'hse';
        $ptw->berlaku_dari = $request->berlaku_dari;
        $ptw->berlaku_sampai = $request->berlaku_sampai;
        $ptw->manpower_qty = $request->manpower_qty;
        $ptw->remark = $request->remark ?? '';
        $ptw->created_by = auth()->user()->name;
        $ptw->catatan_hse = '';
        $ptw->approved_by = '';
        $ptw->rejected_by = '';
        $ptw->status = '';
        $ptw->save();

        foreach ($request->input('tools', []) as $tools) {
            ptw_tools::create([
                'ptw_id' => $ptw->id,
                'tools_id' => $tools,
            ]);
        }

        foreach ($request->input('permission_tambahan', []) as $permission) {
            ptw_permission::create([
                'ptw_id' => $ptw->id,
                'permission_id' => $permission,
            ]);
        }

        return redirect()->back();
    }

    public function UpdatePtw(Request $request)
    {
        $ptw = ptw::find($request->id_ptw);
        $ptw->project_id = $request->project_id;
        $ptw->permission_id = $request->permission_id;
        $ptw->work_location_id = $request->location_id;
        $ptw->berlaku_dari = $request->berlaku_dari;
        $ptw->berlaku_sampai = $request->berlaku_sampai;
        $ptw->manpower_qty = $request->manpower_qty;
        $ptw->catatan_hse = $request->catatan_hse ?? '';
        $ptw->remark = $request->remark ?? '';
        $ptw->save();

        ptw_tools::where('ptw_id', $request->id_ptw)->delete();
        ptw_permission::where('ptw_id', $request->id_ptw)->delete();

        foreach ($request->input('tools', []) as $tools) {
            ptw_tools::create([
                'ptw_id' => $ptw->id,
                'tools_id' => $tools,
            ]);
        }

        foreach ($request->input('permission_tambahan', []) as $permission) {
            ptw_permission::create([
                'ptw_id' => $ptw->id,
                'permission_id' => $permission,
            ]);
        }

        return redirect()->back();
    }

    public function deletePtw(Request $request)
    {
        ptw::find($request->id_ptw)->delete();
        ptw_tools::where('ptw_id', $request->id_ptw)->delete();
        ptw_permission::where('ptw_id', $request->id_ptw)->delete();

        return redirect()->back();
    }

    public function acc(Request $request)
    {
        $ptw = ptw::find($request->id_ptw);
        if (Auth::user()->can('hse') || Auth::user()->can('admin')) {
            $ptw->level = 'kabeng';
        }
        elseif (Auth::user()->can('kabeng')) {
            $ptw->level = 'kapro';
        }
        elseif (Auth::user()->can('kapro')) {
            $ptw->level = 'approved';
            $ptw->status = 'onprogress';
        }
        $ptw->approved_by = auth()->user()->name;
        $ptw->save();

        return redirect()->back();
    }

    public function reject(Request $request)
    {
        $ptw = ptw::find($request->id_ptw);
        if (Auth::user()->can('hse') || Auth::user()->can('admin')) {
            $ptw->level = 'rejected';
            $ptw->rejected_by = Auth::user()->name;
        }
        elseif (Auth::user()->can('kabeng')) {
            $ptw->level = 'rejected';
            $ptw->rejected_by = Auth::user()->name;
        }
        elseif (Auth::user()->can('kapro')) {
            $ptw->level = 'rejected';
            $ptw->rejected_by = Auth::user()->name;
        }
        $ptw->approved_by = auth()->user()->name;
        $ptw->save();

        return redirect()->back();
    }

    public function mulai(Request $request)
    {
        $ptw = ptw::find($request->id_ptw);
        $ptw->status = 'onprogress';
        $ptw->save();

        return redirect()->back();
    }

    public function hold(Request $request)
    {
        $ptw = ptw::find($request->id_ptw);
        $ptw->status = 'onhold';
        $ptw->save();

        return redirect()->back();
    }

    public function done(Request $request)
    {
        $ptw = ptw::find($request->id_ptw);
        $ptw->status = 'done';
        $ptw->save();

        return redirect()->back();
    }

    public function InputDetailTambahan($id)
    {
        $detail_tambahan = permission_tambahan::select('id', 'permission_name')->where('permission_type_id', $id)->get();

        return json_encode($detail_tambahan);
        // return $id;
    }

    public function InputApd($id)
    {
        $apd = tools_type::select('id', 'tools_name')->where('permission_type_id', $id)->get();

        return json_encode($apd);
    }

    public function DetailTambahan($id)
    {
        $detail_tambahan = ptw_permission::select('permission_name')->join('permission_tambahans', 'permission_tambahans.id', '=', 'ptw_permissions.permission_id')
        ->where('ptw_id', $id)->get();

        return json_encode($detail_tambahan);
    }

    public function Apd($id)
    {
        $apd = ptw_tools::select('tools_name')->join('tools_types', 'tools_types.id', '=', 'ptw_tools.tools_id')
        ->where('ptw_id', $id)->get();

        return json_encode($apd);
    }

    public function download($id)
    {
        $datas = ptw::join('projects', 'ptws.project_id', '=', 'projects.id')
                    ->join('work_locations', 'ptws.work_location_id', '=', 'work_locations.id')
                    ->join('permission_types', 'ptws.work_location_id', '=', 'work_locations.id')
                    ->select('ptws.id as ptw_id' ,'ptws.*',  'projects.*', 'work_locations.*')
                    ->where('ptws.id', $id)
                    ->first();
        $datas_instruksi = permission_tambahan::select('permission_name')->where('permission_type_id', $datas->permission_id)->get();
        $apd = ptw_tools::join('tools_types', 'ptw_tools.tools_id', '=', 'tools_types.id')
                    ->select('tools_name')->where('permission_type_id', $datas->permission_id)->get();
        // dd($apd);
        // dd($datas->permission_id);
        // dd($datas_instruksi);
        // $pdf = PDF::loadView('pdf', compact('datas', 'datas_instruksi', 'apd'));
        $pdf = PDF::loadView('pdf', compact('datas', 'datas_instruksi', 'apd'))
          ->setPaper([0, 0, 1000, 1380]);

        return $pdf->download('your-document.pdf');
        // return view('pdf', compact('datas', 'datas_instruksi', 'apd'));
    }

    public function locationMaster()
    {
        $data = work_location::all();

        return view('datamaster.locationMaster', compact('data'));
    }

    public function locationMasterAdd(Request $request)
    {
        $data = New work_location();
        $data->location_name = $request->name;
        $data->save();

        return redirect()->back();
    }

    public function locationMasterEdit(Request $request)
    {
        $data = work_location::find($request->id);
        $data->location_name = $request->location;
        $data->save();

        return redirect()->back();
    }

    public function locationMasterDelete(Request $request)
    {
        $data = work_location::find($request->id)->delete();
        return redirect()->back();
    }

    // Project Master Methods
    public function projectMaster()
    {
        $data = project::all();

        return view('datamaster.projectMaster', compact('data'));
    }

    public function projectMasterAdd(Request $request)
    {
        $data = New project();
        $data->project_code = $request->code;
        $data->project_name = $request->name;
        $data->save();
        
        return redirect()->back();
    }

    public function projectMasterEdit(Request $request)
    {
        $data = project::find($request->id);
        $data->project_code = $request->project_code;
        $data->project_name = $request->project_name;
        $data->save();
        
        return redirect()->back();
    }

    public function projectMasterDelete(Request $request)
    {
        $data = project::find($request->id)->delete();
        
        return redirect()->back();
    }

    // User Management Methods
    public function userManagement()
    {
        $data = User::all();
        $roles = DB::SELECT('SELECT name FROM roles');
        $roles = collect($roles)->pluck('name');

        return view('user.userManagement', compact('data', 'roles'));
    }

    public function userManagementAdd(Request $request)
    {
        $data = New User();
        $data->name = $request->name;
        $data->email = $request->email;
        $data->password = Hash::make($request->password);
        $data->save();

        $data->assignRole($request->role);
        
        return redirect()->back();
    }

    public function userManagementEdit(Request $request)
    {
        $data = User::find($request->id);
        $data->name =$request->name;
        $data->email = $request->email;
        $data->save();
        $data->removeRole($request->roleBefore);
        $data->assignRole($request->role);
        
        return redirect()->back();
    }

    public function userManagementDelete(Request $request)
    {
        $data = User::find($request->id)->delete();
        
        return redirect()->back();
    }

    public function createJSA(Request $request)
    {
        if (!$request->pelaksana_jsa || !$request->penyusun_jsa) {
            return redirect()->back()->withErrors(['message' => 'Penyusun / Pelaksana tidak boleh kosong']);
        }
        $data = New jsa();
        $data->ptw_id = $request->ptw_id;
        $data->supervisi_name = $request->supervisi;
        $data->project_code = $request->project_code;
        $data->judul_pekerjaan = $request->judul_pekerjaan;
        $data->tempat_bekerja = $request->tempat_bekerja;
        $data->uraian_tugas = $request->uraian_tugas ?? '';
        $data->plant_loc = $request->plant_location ?? '';
        $data->review = '';
        $data->reviewed_by = '';
        $data->reviewed_date = '';
        $data->save();

        foreach ($request->pelaksana_jsa as $value) {
            $user_pelaksana = New user_jsa();
            $user_pelaksana->jsa_id = $data->id;
            $user_pelaksana->jenis = 'pelaksana';
            $user_pelaksana->nama = $value;
            $user_pelaksana->save();
        }

        foreach ($request->penyusun_jsa as $value) {
            $user_penyusun = New user_jsa();
            $user_penyusun->jsa_id = $data->id;
            $user_penyusun->jenis = 'penyusun';
            $user_penyusun->nama = $value;
            $user_penyusun->save();
        }

        if ($request->addLK) {
            foreach ($request->addLK as $value) {
                $addLKs = New LK();
                $addLKs->jsa_id = $data->id;
                $addLKs->nama = $value;
                $addLKs->save();
            }
        }

        if ($request->addPB) {
            foreach ($request->addPB as $value) {
                $addPBs = New PB();
                $addPBs->jsa_id = $data->id;
                $addPBs->nama = $value;
                $addPBs->save();
            }
        }

        if ($request->addPPE) {
            foreach ($request->addPPE as $value) {
                $addPPEs = New PPE();
                $addPPEs->jsa_id = $data->id;
                $addPPEs->nama = $value;
                $addPPEs->save();
            }
        }

        if ($request->addPerson) {
            foreach ($request->addPerson as $value) {
                $addPersons = New Person();
                $addPersons->jsa_id = $data->id;
                $addPersons->nama = $value;
                $addPersons->save();
            }
        }

        return redirect()->back();
    }

    public function UpdateJSA(Request $request)
    {
        $data = jsa::find($request->id);
        $data->supervisi_name = $request->supervisi;
        $data->project_code = $request->project_code;
        $data->judul_pekerjaan = $request->judul_pekerjaan;
        $data->tempat_bekerja = $request->tempat_bekerja;
        $data->uraian_tugas = $request->uraian_tugas;
        $data->plant_loc = $request->plant_location;
        $data->save();

        $user_jsa = user_jsa::where('jsa_id', $request->id)->delete();

        foreach ($request->pelaksana_jsa as $value) {
            $user_pelaksana = New user_jsa();
            $user_pelaksana->jsa_id = $data->id;
            $user_pelaksana->jenis = 'pelaksana';
            $user_pelaksana->nama = $value;
            $user_pelaksana->save();
        }

        foreach ($request->penyusun_jsa as $value) {
            $user_penyusun = New user_jsa();
            $user_penyusun->jsa_id = $data->id;
            $user_penyusun->jenis = 'penyusun';
            $user_penyusun->nama = $value;
            $user_penyusun->save();
        }


        if ($request->addLK) {
            $a = LK::where('jsa_id', $request->id)->delete();
            foreach ($request->addLK as $value) {
                $addLKs = New LK();
                $addLKs->jsa_id = $data->id;
                $addLKs->nama = $value;
                $addLKs->save();
            }
        }

        if ($request->addPB) {
            $b = PB::where('jsa_id', $request->id)->delete();
            foreach ($request->addPB as $value) {
                $addPBs = New PB();
                $addPBs->jsa_id = $data->id;
                $addPBs->nama = $value;
                $addPBs->save();
            }
        }

        if ($request->addPPE) {
            $c = PPE::where('jsa_id', $request->id)->delete();
            foreach ($request->addPPE as $value) {
                $addPPEs = New PPE();
                $addPPEs->jsa_id = $data->id;
                $addPPEs->nama = $value;
                $addPPEs->save();
            }
        }

        if ($request->addPerson) {
            $d = Person::where('jsa_id', $request->id)->delete();
            foreach ($request->addPerson as $value) {
                $addPersons = New Person();
                $addPersons->jsa_id = $data->id;
                $addPersons->nama = $value;
                $addPersons->save();
            }
        }

        return redirect()->back();
    }

    public function UpdateStatusReviewJSA(Request $request)
    {
        $data = jsa::find($request->id);
        $data->review = 'Y';
        $data->reviewed_by = Auth::user()->name;
        $data->reviewed_date = date('Y-m-d');
        $data->save();

        return redirect()->back();
    }

    public function deleteJSA(Request $request)
    {
        $data = jsa::find($request->id)->delete();

        return redirect()->back();
    }

    public function userPenyusunJsa($id)
    {
        $data = user_jsa::where('jsa_id', $id)->where('jenis', 'penyusun')->get();

        return json_encode($data);
    }

    public function userPelaksanaJsa($id)
    {
        $data = user_jsa::where('jsa_id', $id)->where('jenis', 'pelaksana')->get();

        return json_encode($data);
    }

    public function PertimbanganLKJSA($id)
    {
        $data = LK::where('jsa_id', $id)->get();

        return json_encode($data);
    }

    public function PertimbanganPBJSA($id)
    {
        $data = PB::where('jsa_id', $id)->get();

        return json_encode($data);
    }

    public function PertimbanganPPEJSA($id)
    {
        $data = PPE::where('jsa_id', $id)->get();
        
        return json_encode($data);
    }

    public function PertimbanganPersonJSA($id)
    {
        $data = Person::where('jsa_id', $id)->get();

        return json_encode($data);
    }

    public function statusJHA($id)
    {
        $data = jsa::find($id);

        if ($data->review == 'Y') {
            $status = 'Y';
        } else {
            $status = 'N';
        }

        return json_encode($status);
    }
}
