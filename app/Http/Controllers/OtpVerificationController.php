<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class OtpVerificationController extends Controller
{
    public function show(Request $request): View|RedirectResponse
    {
        if (!$request->session()->has('otp_user_id')) {
            return redirect()->route('login');
        }

        $user = User::find($request->session()->get('otp_user_id'));

        if (!$user) {
            $request->session()->forget([
                'otp_user_id',
                'otp_remember',
            ]);

            return redirect()->route('login');
        }

        return view('auth.otp-verify');
    }

    public function verify(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'code' => ['required', 'string', 'size:6'],
        ]);

        $userId = $request->session()->get('otp_user_id');
        $user = User::find($userId);

        if (!$user) {
            $request->session()->forget([
                'otp_user_id',
                'otp_remember',
            ]);

            return redirect()->route('login');
        }

        if (!$user->verifyOtp($validated['code'])) {
            return back()
                ->withErrors([
                    'code' => 'El código ingresado no es válido o ha expirado.',
                ])
                ->onlyInput('code');
        }

        $remember = $request->session()->get('otp_remember', false);

        $user->forceFill([
            'otp_code' => null,
            'otp_expires_at' => null,
        ])->save();

        $request->session()->forget([
            'otp_user_id',
            'otp_remember',
        ]);

        Auth::guard('web')->login($user, $remember);

        $request->session()->regenerate();

        return redirect()->intended(route('dashboard', absolute: false));
    }

    public function resend(Request $request): RedirectResponse
    {
        $userId = $request->session()->get('otp_user_id');
        $user = User::find($userId);

        if (!$user) {
            $request->session()->forget([
                'otp_user_id',
                'otp_remember',
            ]);

            return redirect()->route('login');
        }

        $otp = $user->generateOtp();

        Mail::send(
            'emails.otp',
            [
                'otp' => $otp,
                'user' => $user,
            ],
            function ($message) use ($user) {
                $message->to($user->email)
                    ->subject('Nuevo código de verificación');
            }
        );

        return back()->with(
            'status',
            'Se ha enviado un nuevo código a tu correo.'
        );
    }
}
