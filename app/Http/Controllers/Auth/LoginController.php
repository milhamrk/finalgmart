<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:admin')->except('logout');
        $this->middleware('guest:kios')->except('logout');    
    }

    public function login(Request $request)
    {
        // $request->validate([
        //     'email' => 'required|email|exists:admins,email',
        //     'password' => 'required'
        // ]);

        $auth = $request->except(['remember_me']);
        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember_me)) {
            $token = Str::random(40);
            $user = Auth::guard('admin')->user();
            $user->token = $token;
            $user->save();
            return response()->json(['status' => 'success', 'data' => Auth::guard('admin')->user()->token, 'role' => Auth::guard('admin')->user()->role, 'email' => $request->email], 200);
        }
        elseif (Auth::guard('kios')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember_me)) {
            $token = Str::random(40);
            $user = Auth::guard('kios')->user();
            $user->token = $token;
            $user->save();
            return response()->json(['status' => 'success', 'data' => Auth::guard('kios')->user()->token, 'role' => '3', 'email' => $request->email], 200);
        }
        return response()->json(['status' => 'failed']);
    }

    public function token(){
        return auth('admin-api')->user();
    }
}
