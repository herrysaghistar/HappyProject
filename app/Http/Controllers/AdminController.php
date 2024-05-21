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
    	$data = ptw::where('level', 'admin')->get();
    	
    	return view('permission.permission', compact('data'));
    }

    public function create(Request $request)
    {
    	ptw::create([
    		// field and input
    	]);

    	foreach ($request->input('tools', []) as $tools_name) {
	        // Create a user
	        ptw_tools::create([
	            'tools_id' => ,
	            'tools_id' => ucfirst(strtolower($tools_name)),
	        ]);
	    }
    }
}
