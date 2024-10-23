<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Http\Mail\UserEmail;

class UserController extends Controller
{
    public function registerUser(Request $request){
        $request->validate([
            'username' => 'required',
            'email' => 'required', 
            'password' => 'required', 
            'confirm_password' => 'required|confirmed:password'
        ],
        [
            'username.required' => 'Name field is required',
            'email.required' => 'Email field is required', 
            'password.required' => 'Password is required',
            'confirm_password.required' => 'Confirm password is required',
            'confirm_password.confirmed' => 'Password is not matching',

        ] 
    );

        User::create([
            'name' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        $details =[
            'username' =>$request->username,
            'subject' => "Email Verification"
        ];
        Mail::to($request->email)->send(new UserEmail($details));
        return redirect()->back()->with('registerSuccess', 'User registered successfully');
    }


    public function loginUser(Request $request) {
       $credentials = $request->validate([
            'email' => 'required', 
            'password' => 'required'
        ], 
    [
        'email.required' => 'Email field is required',
        'password.required' => 'Password field is required'
    ]);

    if(Auth::attempt($credentials)){
        $user = Auth::user();
        $username =$user->name;
        $details =[
            'email' => $request->email,
            'username' => $username
        ];
        return redirect()->route('dashboard');
    }
    else{
        return redirect()->back();
    }
    }

    public function viewDashboard() {
        return view('dashboard');
    }
}
