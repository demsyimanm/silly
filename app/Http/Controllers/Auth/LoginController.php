<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
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
    protected $redirectTo = '/backend/dashboard';

    protected $username = 'username';

    protected $redirectAfterLogout = '/backend/auth';

    protected $guard = 'admin';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function index(){
        return view('backend.auth.login');
    }

    public function login(Request $request){
        if ( \Auth::attempt(['username' => $request['username'], 'password' => $request['password'] ])){
            return redirect('/backend/dashboard');
        }

        return redirect()->back()->withErrors(['errors' => 'These credentials do not match our records. ']);

    }

    public function logout()
    {
        \Auth::guard('admin')->logout();
        return redirect('login');
    }
}
