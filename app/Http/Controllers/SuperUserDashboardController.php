<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SuperUserDashboardController extends Controller
{
    public function index(Request $request)
    {
        // For this static example, hardcode SuperUser info.
        $superUser = [
            'name' => 'admin1',
            'email' => 'admin1@gmail.com'
        ];
        return view('superuser.dashboard', compact('superUser'));
    }
}
