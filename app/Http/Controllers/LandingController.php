<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index()
    {
        if (auth()->check()) {
            return redirect()->route(
                auth()->user()->is_admin ? 'admin.dashboard' : 'user.dashboard'
            );
        }
    
        return view('index');
    }
}