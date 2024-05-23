<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ptw;

class KaproController extends Controller
{
    public function index()
    {
    	$data = ptw::join('projects', 'ptws.project_id', '=', 'projects.id')
    				->select('ptws.id as ptw_id' ,'ptws.*',  'projects.*')
                    ->whereIn('level', ['kapro', 'approved'])
    				->get();
    	
    	return view('permission.permission', compact('data'));
    	
    	return view('permission.permission', compact('data'));
    }
}
