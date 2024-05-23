<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\project;
use App\Models\permission_type;
use App\Models\tools_type;
use App\Models\ptw;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
    	$data = ptw::join('projects', 'ptws.project_id', '=', 'projects.id')
    				->select('ptws.id as ptw_id' ,'ptws.*',  'projects.*')
    				->get();
    	
    	return view('permission.permission', compact('data'));
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
