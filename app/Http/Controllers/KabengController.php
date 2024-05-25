<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ptw;

class KabengController extends Controller
{
    public function index()
    {
    	$data = ptw::join('projects', 'ptws.project_id', '=', 'projects.id')
                    ->join('work_locations', 'ptws.work_location_id', '=', 'work_locations.id')
                    ->select('ptws.id as ptw_id' ,'ptws.*',  'projects.*', 'work_locations.*')
    				->whereIn('level', ['kabeng', 'approved', 'rejected'])
    				->get();
    	
    	return view('permission.permission', compact('data'));
    	
    	return view('permission.permission', compact('data'));
    }
}
