<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KaproController extends Controller
{
    public function index()
    {
    	return view('permission.permission');
    }
}
