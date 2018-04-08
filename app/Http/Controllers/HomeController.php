<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\User;
use Illuminate\View\View;

/**
 * Class HomeController.
 */
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return View
     */
    public function index(): View
    {
        return view('home', [
            'users' => User::all(),
        ]);
    }
}
