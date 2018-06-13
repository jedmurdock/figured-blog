<?php

namespace FiguredBlog\Http\Controllers\Auth;

use FiguredBlog\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    */

    use AuthenticatesUsers;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Login via API, generates and saves API token
     */
    public function api_login(Request $request)
    {
        $this->validateLogin($request);

        if ($this->attemptLogin($request)) {
            $user = $this->guard()->user();
            $user->makeApiToken();

            return response()->json([
                'data' => $user->toArray(),
            ]);
        }

        return response()->json(['error' => 'login failure']);
    }

    public function login(Request $request)
    {
        $response = $this->api_login($request);

        if (json_decode($response)['data']['id']) {
            return redirect('/');
        }

        return $this->sendFailedLoginResponse($request);
    }

    /**
     * Logout via API, removes user's API token
     */
    public function api_logout(Request $request)
    {
        $user = \Auth::guard('api')->user();

        if ($user) {
            $user->api_token = null;
            $user->save();
        }
        $this->guard()->logout();

        return response()->json(['data' => 'User logged out'], 200);
    }

    public function logout(Request $request)
    {
        $this->api_logout($request);
        $request->session()->invalidate();

        return redirect('/');
    }
}
