<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ptw;
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
        $ptw->level = 'spv';
        $ptw->project_id = '1';
        $ptw->berlaku_dari = $request->berlaku_dari;
        $ptw->berlaku_sampai = $request->berlaku_sampai;
        $ptw->manpower_qty = $request->manpower_qty;
        $ptw->remark = $request->remark;
        $ptw->created_by = auth()->user()->name;
        $ptw->approved_by = '';
        $ptw->rejected_by = '';
        $ptw->status = '';
        $ptw->save();

        foreach ($request->input('tools', []) as $tools_name) {
            ptw_tools::create([
                'ptw_id' => $ptw->id,
                'tools_id' => $tools_name,
            ]);
        }

        foreach ($request->input('permission', []) as $permission_name) {
            ptw_tools::create([
                'ptw_id' => $ptw->id,
                'permission_id' => $permission_name,
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

    public function startJob()
    {
        
    }

    public function endJob()
    {
        
    }

    public function download($id)
    {
        $data = ptw::join('projects', 'ptws.project_id', '=', 'projects.id')
                    ->select('ptws.id as ptw_id' ,'ptws.*',  'projects.*')
                    ->where('ptws.id', $id)
                    ->first();
        $pdf = PDF::loadView('pdf', compact('data'));
        // return $pdf->download('your-document.pdf');
        return view('pdf', compact('data'));
    }
}
