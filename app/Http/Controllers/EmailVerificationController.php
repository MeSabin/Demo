<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmailVerificationController extends Controller
{
    public function verifyUser($token): RedirectResponse
    {
        $user = User::where('verification_token', $token)->first();
        if ($user) {
            $user->verification_token = null;
            $user->email_verified_at = now();
            $user->save();
            Auth::login($user);  // logs in the user so that middleware doesnot interfere

            //message
            return redirect()->route('dashboard')->with('loginSuccess', 'You are verified now !');
        }

        return redirect()->route('tokenExpired');
    }

    public function tokenExpired(): View
    {
        return view('token-expired');
    }
}
