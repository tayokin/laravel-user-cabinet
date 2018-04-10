<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Traits\AccountKitTrait;
use App\Traits\PhoneTrait;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * Class RegisterController.
 */
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;
    use PhoneTrait;
    use AccountKitTrait;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data): \Illuminate\Contracts\Validation\Validator
    {
        return Validator::make($data, [
            'name'         => 'required|string|max:255',
            'phone_code'   => 'required|string|max:255',
            'phone_number' => 'required|string|max:255',
            'password'     => 'required|string|min:1|confirmed',
        ]);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function register(Request $request): RedirectResponse
    {
        $this->validator($request->all())->validate();

        $data          = $request->all();
        $data['phone'] = $this->getPhoneFromCodeAndNumber($request->get('phone_code'), $request->get('phone_number'));
        $data['token'] = csrf_token();

        if ($user = User::findByPhone($data['phone'])) {
            $user->update(['registration_token' => $data['token']]);
        } else {
            $user = User::createFromData($data);
            event(new Registered($user));
        }

        return redirect()->away($this->getSmsUrl($data['token'], $request->get('phone_number')));
    }
}
