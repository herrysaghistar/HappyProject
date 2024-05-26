<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ptw;
use App\Models\tools_type;
use App\Models\permission_tambahan;
use App\Models\project;
use App\Models\work_location;
use App\Models\permission_type;
use DB;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
    	$data = Ptw::select(
                        'ptws.id as ptw_id',
                        'ptws.*',
                        'projects.*',
                        'work_locations.*',
                        'permission_types.*',
                        DB::raw('GROUP_CONCAT(DISTINCT permission_tambahans.permission_name) as permission_names'),
                        DB::raw('GROUP_CONCAT(DISTINCT tools_types.tools_name) as tools_names')
                    )
                    ->join('projects', 'ptws.project_id', '=', 'projects.id')
                    ->join('work_locations', 'ptws.work_location_id', '=', 'work_locations.id')
                    ->join('permission_types', 'ptws.permission_id', '=', 'permission_types.id')
                    
                    ->leftJoin('ptw_permissions', 'ptws.id', '=', 'ptw_permissions.ptw_id')
                    ->leftJoin('permission_tambahans', 'ptw_permissions.permission_id', '=', 'permission_tambahans.id')
                    
                    ->leftJoin('ptw_tools', 'ptws.id', '=', 'ptw_tools.ptw_id')
                    ->leftJoin('tools_types', 'ptw_tools.tools_id', '=', 'tools_types.id')
                    ->groupBy('ptws.id')
                    ->get();

        $tools = tools_type::all();
        $permission_tambahan = permission_tambahan::all();
        $project = project::all();
        $work_location = work_location::all();
        $permission_type = permission_type::all();

        return view('permission.permission', compact('data', 'project', 'work_location', 'permission_type', 'permission_tambahan', 'tools'));
    }

    public function create(Request $request)
    {
    	$ptw = New ptw;
    	$ptw->level = 'spv';
    	$ptw->status = '';
    	$ptw->berlaku_dari = $request->berlaku_dari;
    	$ptw->berlaku_sampai = $request->berlaku_sampai;
    	$ptw->manpower_qty = $request->manpower_qty;
    	$ptw->remark = $request->remark;
    	$ptw->approved_by = '';
    	$ptw->save();

    	foreach ($request->input('tools', []) as $tools_name) {
	        // Create a user
	        ptw_tools::create([
	            'ptw_id' => $ptw->id,
	            'tools_id' => $tools_name,
	        ]);
	    }

        return redirect()->back();
    }
}
