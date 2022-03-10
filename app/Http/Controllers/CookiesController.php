<?php

namespace App\Http\Controllers;

use App\Http\Requests\BuyCookies as BuyCookiesRequest;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class CookiesController extends Controller
{
    /**
     * Show buy cookies page.
     *
     * @return Renderable
     */
    public function index()
    {
        return view('buy.cookies');
    }

    /**
     * Make a cookie purchase.
     *
     * @param BuyCookiesRequest $request
     * @return Response|RedirectResponse
     */
    public function buy(BuyCookiesRequest $request)
    {
        $user = Auth::user();
        $cookies = $request->input('cookies');

        if ($cookies > $user->wallet) {
            return back()->withErrors([
                'message' => 'Insufficient funds on the balance.',
            ])->withInput();
        }

        $newAmount = $user->wallet - $cookies;

        $user->update(['wallet' => $newAmount]);

        $cookiesNumberString = $cookies . ' ' . Str::plural('cookie', $cookies);

        Log::info("User $user->email have bought $cookiesNumberString");

        return response("Success, you have bought $cookiesNumberString!");
    }
}
