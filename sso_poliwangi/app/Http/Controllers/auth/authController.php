<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class authController extends Controller
{
    
    public function loginPage()
    {
        return view('auth.login');
    }

    public function authenticationLogin(Request $request) 
    {
        $credentialsAccount = $request->validate([
            'nim' => ['required', 'max:255'],
            'password' => ['required', 'max:255'],
        ]);
        if(auth::guard('mahasiswa')->attempt($credentialsAccount))
        {
            $request-> session()->regenerate();
            return redirect()->intended('/oauth/redirect');
        }
        else {
            return back()->with('loginFailed', '[Kredensial Tidak Cocok] Harap Coba Lagi.');
        }
    }
    public function changesAccount(Request $request)
    {
        auth::logout();
        Session::put('url_intended', $request->current_url);
        return redirect(route('login'));
    }
}
