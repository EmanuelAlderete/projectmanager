<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        if($user->can('super-admin')) {
            return view('admin.index', [
                'title' => 'Dashboard'
            ]);
        } else if ($user->can('access-menu')) {
            return view('app.index', [
                'title' => 'Dashboard'
            ]);
        }
        
    }
}
