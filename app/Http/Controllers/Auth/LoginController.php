<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Traits\AccountKitTrait;
use App\Traits\PhoneTrait;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

/**
 * Class LoginController.
 */
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
    use PhoneTrait;
    use AccountKitTrait;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function login(Request $request): RedirectResponse
    {
        if (!$user = User::findByPhone($this->getPhoneFromCodeAndNumber($request->get('phone_code'), $request->get('phone_number')))) {
            return redirect()->route('register');
        }
        $user->update(['registration_token ' => csrf_token()]);

        return redirect()->away($this->getSmsUrl($user->registration_token, $request->get('phone_number')));
    }
}
