<?php

namespace App\Http\Controllers\Auth;

use App\User;
use JWTAuth;
use App\Http\Requests;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
//use Dingo\Api\Routing\Helpers;
use Illuminate\Mail\Message;

use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    //use Helpers;

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
    protected $redirectTo = '/';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    // JWT Authentication
    public function authenticate(Request $request)
    {
        // grab credentials from the request
        $credentials = $request->only('email', 'password');
        try {
            // attempt to verify the credentials and create a token for the user
            if (!$token = JWTAuth::attempt($credentials)) {
                 return $this->response->errorUnauthorized();
                // return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
             return $this->response->errorInternal();
            // return response()->json(['error' => 'could_not_create_token'], 500);
        }
        // all good so return the token
         return $this->response->array(compact('token'))->setStatusCode(200);
        // return response()->json(compact('token'));
    }

    // fetch all users
    public function index()
    {
        try {
            return User::all();
        }
        catch (Exception $ex) {
            return $ex;
        }
        
    }

    // fetch user detail based on id w/o authentication
    public function show()
    {
        try {
            return JWTAuth::parseToken()->toUser();

            if (! $user) {
                return $this->response->errorNotFound('User not found!');
            }           
        }
        catch (\Tymon\JWTAuth\Exceptions\JWTException $ex) {
            return $this->response->error('Something went wrong!');
        }

        return $this->response->array(compact('user'))->setStatusCode(200);
    }

    // refresh token
    public function getToken()
    {
        $token = JWTAuth::getToken();

        if (! $token) {
            return $this->response->errorUnauthorized("Token is invalid!");
        }

        try {
            $refreshedToken = JWTAuth::refresh($token);
        } catch (JWTException $ex) {
            $this->response->error('Something went wrong!');
        }

        return $this->response->array(compact('token'));
    }

    // delete user
    public function destroy()
    {
        $user = JWTAuth::parseToken()->authenticate();

        if (! $user) {
            // fail the delete process

        }

        // if not go with the delete process

        $user->delete();
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
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
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
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
}
