<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use App\Services\Auth\AuthenticationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    protected $request;
    protected $authenticationService;

    public function __construct()
    {
        $this->authenticationService = new AuthenticationService;
    }

    protected function redirectPath()
    {
        return RouteServiceProvider::HOME;
    }

    public function redirectToProvider()
    {

        $redirectAuthorization = $this->authenticationService->requestAuthentication();
        if (!$redirectAuthorization['status']) {
            return abort(500, 'Token Appota Pay không hợp lệ.');
        }
        return redirect($redirectAuthorization['redirect_uri']);
    }

    public function handleCallback(Request $request)
    {

        $accessToken = $this->authenticationService->requestAccessToken($request->authorization_code);

        if (!$accessToken['status']) {
            return abort(500);
        }
        $userData = $this->authenticationService->checkValidAccessToken($accessToken['access_token']);

        if (!$userData['status']) {
            abort(500);
        }
        $userData = $userData['data']['user_info'];
        $authUser = User::firstOrCreate([
            'email' => $userData['email']
        ], [
            'phone' => $userData['phone_number'],
            'name' => $userData['full_name'],
            'avatar' => $userData['avatar'],
            'is_active' => $userData['status'] === 'active' ? true : false,
        ]);

        if (!$authUser->is_active) {
            abort(403, 'Tài khoản đã bị khóa');
        }

        Auth::login($authUser);
        // dd($authUser);

        $request->session()->regenerate();

        return redirect()->intended($this->redirectPath());
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return $request->wantsJson()
            ? response()->json([], 204)
            : redirect('/');
    }
}
