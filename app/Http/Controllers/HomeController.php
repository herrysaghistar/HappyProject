<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ptw;
use \PDF;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('dashboard.index');
    }

    public function acc(Request $request)
    {
        $ptw = ptw::find($request->id_ptw);
        if (Auth::user()->can('hse') || Auth::user()->can('admin')) {
            $ptw->level = 'kabeng';
        }
        elseif (Auth::user()->can('kabeng')) {
            $ptw->level = 'kapro';
        }
        elseif (Auth::user()->can('kapro')) {
            $ptw->status = 'Y';
            $ptw->level = 'approved';
        }
        $ptw->approved_by = auth()->user()->name;
        $ptw->save();

        return redirect()->back();
    }

    public function reject(Request $request)
    {
        $ptw = ptw::find($request->id_ptw);
        $ptw->status = 'N';
        if (Auth::user()->can('hse') || Auth::user()->can('admin')) {
            $ptw->level = 'hse';
        }
        elseif (Auth::user()->can('kabeng')) {
            $ptw->level = 'hse';
        }
        elseif (Auth::user()->can('kapro')) {
            $ptw->level = 'kapro';
        }
        $ptw->approved_by = auth()->user()->name;
        $ptw->save();

        return redirect()->back();
    }

    public function download($id)
    {
        $data = ptw::find($id);
        $pdf = PDF::loadView('pdf', compact('data'))
        // return $pdf->download('your-document.pdf');
        return view('pdf');
    }
}
