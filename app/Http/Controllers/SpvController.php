<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SpvController extends Controller
{
    public function index()
    {
    	$data = ptw::where('level', 'admin')->get();
    	
    	return view('permission.permission', compact('data'));
    }
}
