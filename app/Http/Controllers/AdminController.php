<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\project;
use App\Models\permission_type;
use App\Models\tools_type;
use App\Models\ptw;

class AdminController extends Controller
{
    public function index()
    {
    	$data = ptw::join('karyawans', 'ptws.karyawan_id', '=', 'karyawans.id')
    				->join('projects', 'ptws.project_id', '=', 'projects.id')
    				->select('ptws.*', 'karyawans.*', 'projects.*')
    				->get();
    	
    	return view('permission.permission', compact('data'));
    }

    public function create(Request $request)
    {
    	$ptw = New ptw;
    	$ptw->karyawan_id = $request->karyawan_id;
    	$ptw->level = $request->level;
    	$ptw->status = $request->status;
    	$ptw->berlaku_dari = $request->berlaku_dari;
    	$ptw->berlaku_sampai = $request->berlaku_sampai;
    	$ptw->manpower_qty = $request->manpower_qty;
    	$ptw->remark = $request->remark;
    	$ptw->approved_by = $request->approved_by;
    	$ptw->save();

    	foreach ($request->input('tools', []) as $tools_name) {
	        // Create a user
	        ptw_tools::create([
	            'ptw_id' => $ptw->id,
	            'tools_id' => $tools_name,
	        ]);
	    }
    }
}
