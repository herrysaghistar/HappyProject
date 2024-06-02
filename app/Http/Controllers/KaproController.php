<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ptw;
use App\Models\tools_type;
use App\Models\permission_tambahan;
use App\Models\project;
use App\Models\work_location;
use App\Models\permission_type;
use DB;

class KaproController extends Controller
{
    public function index()
    {
        $data = Ptw::select(
                        'ptws.id as ptw_id',
                        'ptws.*',
                        'projects.id as project_id',
                        'projects.*',
                        'work_locations.*',
                        'permission_types.*'
                    )
                    ->join('projects', 'ptws.project_id', '=', 'projects.id')
                    ->join('work_locations', 'ptws.work_location_id', '=', 'work_locations.id')
                    ->join('permission_types', 'ptws.permission_id', '=', 'permission_types.id')
                    ->whereIn('level', ['kapro', 'approved', 'rejected'])
                    ->get();

        $tools = tools_type::all();
        $permission_tambahan = permission_tambahan::all();
        $project = project::all();
        $work_location = work_location::all();
        $permission_type = permission_type::all();

        return view('permission.permission', compact('data', 'project', 'work_location', 'permission_type', 'permission_tambahan', 'tools'));
    }
}
