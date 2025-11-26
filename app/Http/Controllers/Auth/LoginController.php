<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    // protected $redirectTo = RouteServiceProvider::HOME;
    protected function authenticated($request, $user)
    {
        if($user->role_as == '0') //0 = Doctor Login
        {
            return redirect('dashboard')->with('status',__('Bienvenido Doctor a FLEBOCENTER'));
        }
        elseif($user->role_as == '1') //1 = Admin/User Login
        {
            return redirect('dashboard')->with('status',__('Bienvenido Usuario a FLEBOCENTER'));
        }
        
        // Default redirect si no hay role_as definido
        return redirect('dashboard')->with('status',__('Bienvenido a FLEBOCENTER'));
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
