<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\AppServiceProvider;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        // Enable this if you want to use "hasVerifiedEmail redirects"
        //if ($request->user()->hasVerifiedEmail()) {
        //    return redirect()->intended(AppServiceProvider::HOME.'?verified=1');
        //}

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        return redirect()->intended(AppServiceProvider::HOME.'?verified=1');
    }
}
