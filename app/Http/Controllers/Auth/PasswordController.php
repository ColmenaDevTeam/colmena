<?php

namespace Colmena\Http\Controllers\Auth;

use Colmena\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Auth;
class PasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Create a new password controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
    /**
    * @override trait
    * Sobreescribir el método del trait para que funcione con el nombre de campo distinto
    */
    protected function resetPassword($user, $password){
        $user->clave = bcrypt($password);

        $user->save();

        Auth::guard($this->getGuard())->login($user);
    }
}
