<?php

namespace App\Http\Controllers;

use App\Models\SuperUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SuperUserAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('superuser.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $superUser = SuperUser::where('email', $request->email)->first();

        if ($superUser && Hash::check($request->password, $superUser->password)) {
            session(['superuser_logged_in' => true]);
            return redirect('superuser/dashboard');
        }
        return back()->withErrors(['email' => 'Invalid credentials']);
    }

    public function logout()
    {
        session()->forget('superuser_logged_in');
        return redirect()->route('superuser.login');
    }

}
