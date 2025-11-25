<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionController extends Controller
{
    /**
     * LogOut
     * Message 1.1: processLogout()
     * Class: ControlSesi
     */
    public function processLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Message 1.1.1: renderPage() -> displayHalamanLogin()
        return redirect('/login');
    }
}
