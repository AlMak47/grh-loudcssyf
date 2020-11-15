<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use \App\Exceptions\ErrorException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    public function connexion(Request $request) {
        try {

            $validation = $request->validate([
                'username'  =>  'required|string',
                'password'  =>  'required|string'
            ],[
                'required'  =>  "`:attribute` requis !"
            ]);

            $credentials = $request->only('username','password');

            if(Auth::attempt($credentials)) {
                // Authenticate passed ...
                return response()
                    ->json('done');
            }
            else {
                throw new ErrorException("Nom d'utilisateur ou Mot de passe incorrect !");
            }
        }
        catch(ErrorException $e) {
            header("Erreur",true,422);
            die(json_encode($e->getMessage()));
        }
    }
    
    
}
