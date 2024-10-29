<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Mail\UserEmail;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\RedirectResponse as HttpFoundationRedirectResponse;

class UserController extends Controller
{
    public function registerUser(RegisterRequest $request): View{
        try{

        $verification_token = Str::random(64);
        $request->merge([
            'password' => Hash::make($request->password),
            'verification_token' => $verification_token,

        ]);
        
        $user = User::create($request->all());
        
        $details =[
            'username' =>$request->name,
            'verification_token' => $verification_token,
        ];
        Mail::to($request->email)->send(new UserEmail($details));
        // return redirect()->back()->with('registerSuccess', 'User registered successfully');
        return view('admin.auth.verification-notice', ['email'=>$request->email]);
    }
    catch(\Exception $e){
        Log::error($e->getMessage());
        return view('admin.auth.verification-notice', ['email'=>$request->email]);
    }

    }


    public function loginUser(LoginRequest $request): RedirectResponse | View {
       $credentials = $request->except(['_token']);


    if(Auth::attempt($credentials)){
        $user = User::where('email', $request->email)->first();
        $email_verified_at = $user->email_verified_at;

        if($email_verified_at == NULL){
            $verification_token = Str::random(64);
            $user->verification_token = $verification_token;
            $user->update();

            $username = $user->name;
            $details =[
                'username' =>$username,
                'verification_token' => $verification_token,
            ];

            Mail::to($request->email)->send(new UserEmail($details));

            return view('admin.auth.verification-notice', ['email'=>$request->email]);
        }
        else{
            return redirect()->route('dashboard');
        }
    }
    else{
        return redirect()->back();
    }
    }

    public function viewDashboard():View 
    {
        return view('admin.dashboard.index');
    }


    public function Logout(Request $request):RedirectResponse
     {
        Auth::logout();
        $request->session()->regenerate();
        $request->session()->flush();
        return redirect()->route('login');
    }
}
