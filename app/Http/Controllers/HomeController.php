<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ptw;
use App\Models\ptw_tools;
use App\Models\ptw_permission;
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
        return view('dashboard.index');
    }

    public function create(Request $request)
    {
        $ptw = New ptw;
        $ptw->project_id = $request->project_id;
        $ptw->permission_id = $request->permission_id;
        $ptw->work_location_id = $request->location_id;
        $ptw->level = 'spv';
        $ptw->berlaku_dari = $request->berlaku_dari;
        $ptw->berlaku_sampai = $request->berlaku_sampai;
        $ptw->manpower_qty = $request->manpower_qty;
        $ptw->remark = $request->remark ?? '';
        $ptw->created_by = auth()->user()->name;
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

    public function done(Request $request)
    {
        $ptw = ptw::find($request->id_ptw);
        $ptw->status = 'done';
        $ptw->save();

        return redirect()->back();
    }

    public function startJob()
    {
        
    }

    public function endJob()
    {
        
    }

    public function download($id)
    {
        $datas = ptw::join('projects', 'ptws.project_id', '=', 'projects.id')
                    ->join('work_locations', 'ptws.work_location_id', '=', 'work_locations.id')
                    ->select('ptws.id as ptw_id' ,'ptws.*',  'projects.*', 'work_locations.*')
                    ->where('ptws.id', $id)
                    ->first();
        $pdf = PDF::loadView('pdf', compact('datas'));
        // return $pdf->download('your-document.pdf');
        return view('pdf', compact('datas'));
    }
}
