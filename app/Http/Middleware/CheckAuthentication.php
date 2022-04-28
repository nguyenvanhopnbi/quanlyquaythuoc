<?php

namespace App\Http\Middleware;

use App\Services\Auth\AuthenticationService;
use Closure;

class CheckAuthentication
{
    protected $authService;

    public function __construct(AuthenticationService $authenticationService)
    {
        $this->authService = $authenticationService;
    }

    /**
     * @param $request
     * @param Closure $next
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|mixed|void
     */
    public function handle($request, Closure $next)
    {
        if ($request->session()->has('Authorization')) {
            $accessToken = $request->session()->get('Authorization');

            $authenToken = $this->authService->checkValidAccessToken($accessToken);
            // user of this cms not permission access this route
            if (!$authenToken['status'] && $authenToken['data']->error == 'not_access_route') {
                return redirect('/error');
            }

            if (!$authenToken['status']) {
                return redirect()->route('logout');
            }
            // when error occur will redirect to login
            if ($authenToken['status'] && isset($authenToken['data']->error)) {
                return $this->redirectAuthentication();
            }
            // merge user info use in controller
            $request->merge([
                'getUser' => $authenToken['data']->user_info
            ]);

            // save session user info
            $request->session()->put('userInfo', $authenToken['data']->user_info);

            return $next($request);
        }
        return $this->redirectAuthentication();
    }

    protected function redirectAuthentication()
    {
        $redirectAuthorization = $this->authService->requestAuthentication();
        if (!$redirectAuthorization['status']) {
            return response()->json([
                'error' => 'invalid_token'
            ], 400);
        }
        return redirect($redirectAuthorization['redirect_uri']);
    }
}
