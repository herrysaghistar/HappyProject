<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ptw;

class KabengController extends Controller
{
    public function index()
    {
    	$data = ptw::join('projects', 'ptws.project_id', '=', 'projects.id')
    				->select('ptws.id as ptw_id' ,'ptws.*',  'projects.*')
    				->where('level', 'kabeng')
    				->get();
    	
    	return view('permission.permission', compact('data'));
    	
    	return view('permission.permission', compact('data'));
    }
}
