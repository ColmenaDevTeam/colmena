<?php
/**
* @author Elias D.
*/
namespace Colmena\Http\Controllers\Auth;

use Colmena\Cusuario;
use Validator;
use Colmena\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;
use Auth;
class AuthController extends Controller
{

    protected $username = "username";
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/cartelera';
    //protected $username = "cedula";

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            //'name' => 'required|max:255',
            'email' => 'required|unique:t_usuarios',
            'password' => 'required|confirmed|min:3'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */

    protected function create(array $data)
    {
        //return User::create(['email' => $data['email'],'password' => bcrypt($data['password']),]);
        return Cusuario::create([
            //'cedula' => $data['email'],
            //'clave' => bcrypt($data['password'])
        ]);
    }
}
