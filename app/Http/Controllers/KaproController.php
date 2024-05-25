<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ptw;
use App\Models\project;
use App\Models\work_location;
use App\Models\permission_type;

class KaproController extends Controller
{
    public function index()
    {
    	$data = ptw::join('projects', 'ptws.project_id', '=', 'projects.id')
                    ->join('work_locations', 'ptws.work_location_id', '=', 'work_locations.id')
                    ->select('ptws.id as ptw_id' ,'ptws.*',  'projects.*', 'work_locations.*')
                    ->whereIn('level', ['kapro', 'approved', 'rejected'])
    				->get();
    	
        $work_location = work_location::all();
        $permission_type = permission_type::all();

        return view('permission.permission', compact('data', 'project', 'work_location', 'permission_type'));
    }
}
