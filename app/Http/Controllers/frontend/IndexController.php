<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Password;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;


class IndexController extends Controller
{
    public function index(){
        return view('welcome');
    }

    public function PasswordResetView(){
        return view('auth.forgot-password');
    }

    public function PasswordResetEmail(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);
$email=$request->email;


$user=User::where('email',$email)->first();

if(!$user){
    return view('frontend.accessdenided');
}
elseif($user->role == 'admin'){
    return view('frontend.accessdenided');
}
else{
    $status = Password::sendResetLink(
        $request->only('email')
    );

    return $status == Password::RESET_LINK_SENT
                ? back()->with('status', __($status))
                : back()->withInput($request->only('email'))
                        ->withErrors(['email' => __($status)]);

    
}

        

    
    }
}
