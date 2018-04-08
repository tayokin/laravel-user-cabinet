<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\AccountKitGetRequest;
use App\User;
use Illuminate\View\View;
use Tayokin\FacebookAccountKit\Facades\FacebookAccountKitFacade;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Redirector;
use Illuminate\Http\RedirectResponse;

/**
 * Class AccountKitController.
 */
class AccountKitController extends Controller
{
    /**
     * @param AccountKitGetRequest $request
     *
     * @return Redirector|RedirectResponse
     *
     * @throws \RuntimeException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function endpoint(AccountKitGetRequest $request)
    {
        if (!$user = User::findByRegistrationToken($request->get('state'))) {
            return redirect()->route('login');
        }

        $fbAccount = FacebookAccountKitFacade::getAccountData($request->get('code'));

        if ($fbAccount['phone'] && $fbAccount['phone'] !== $user->phone) {
            $user->update(['phone' => $fbAccount['phone']]);
        }

        Auth::login($user);

        return redirect()->route('home');
    }

    /**
     * Show the application privacy.
     *
     * @return View
     */
    public function privacy(): View
    {
        return view('privacy');
    }
}
