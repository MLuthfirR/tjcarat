<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ConnectException;
// use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


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

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function index()
    {
        return view('pages.auth.login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required_without:username',
            'password' => 'required',
        ]);

        $body = [
            'email' => $request->input('email', $request->input('username')),
            'password' => $request->input('password'),
            'client_id' => config('token.CLIENT_ID'),
            'client_secret' => config('token.CLIENT_SECRET'),
        ];

        $user = User::where('email', $body['email'])->first();

        if($user){
            if (!Hash::check($body['password'], $user->password)) {
                return redirect()->back()->with('danger', 'Incorrect Email or Password');
            }
        }
        else{
            return redirect()->back()->with('danger', 'User Not found');
        }

        if (!$user->active) {
            // abort($token_response->getStatusCode());
            return redirect()->back()->with('danger', 'Your account has been disabled, please contact admin');
        }

        $role = $user->getRoleNames();
        $data = [
            'username' => $body['email'],
            'password' => $body['password'],
            'grant_type' => 'password',
            'client_id' => $body['client_id'],
            'client_secret' => $body['client_secret'],
            'role' => $role[0],
            'scope' => ''];
        $token_request = Request::create('/oauth/token', 'POST', $data);
        $token_response = app()->handle($token_request);

        if ($token_response->getStatusCode() != 200) {
            // abort($token_response->getStatusCode());
            return redirect()->back()->with('danger', 'Failed to fetch log in token');
        }
        $token = json_decode($token_response->getContent(), true);
        session()->put('user_data', json_encode($data));
        session()->put('user_token', json_encode($token));
        // dd($data);
        return redirect()->back();
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
