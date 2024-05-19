<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Util;

class HomeController extends Controller
{
    public function index()
    {
        $a = Util::Date();

        return $a; 
    }
}
