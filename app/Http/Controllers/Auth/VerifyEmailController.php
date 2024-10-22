<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\pageController;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended(route('home', absolute: false).'?verified=1');
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
            $user = Auth::user();
            $dados = [
                'assunto' => 'Bem-vindo à Nossa Plataforma 🥳',
                'view' => 'emails.email',
            ];
            $pageController = new PageController();
            $pageController->sendMail($dados,$user->email);
        }

        return redirect()->intended(route('home', absolute: false).'?confirmation=success');
    }
}