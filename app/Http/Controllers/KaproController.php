<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ptw;

class KaproController extends Controller
{
    public function index()
    {
    	$data = ptw::join('karyawans', 'ptws.karyawan_id', '=', 'karyawans.id')
    				->join('projects', 'ptws.project_id', '=', 'projects.id')
    				->select('ptws.*', 'karyawans.*', 'projects.*')
                    ->whereIn('level', ['kapro', 'approved'])
    				->get();
    	
    	return view('permission.permission', compact('data'));
    	
    	return view('permission.permission', compact('data'));
    }
}
