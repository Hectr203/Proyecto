<?php

namespace App\Livewire\Modules\Auth\Pages;

use App\Mail\Auth\VerifyEmailOtpMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.guest')]
class VerifyOtp extends Component
{
    public $code = '';

    public string $status = '';

    public function mount()
    {
        if (Auth::check() && Auth::user()->hasVerifiedEmail()) {
            return redirect()->route('dashboard');
        }
    }

    public function verify()
    {
        $this->validate([
            'code' => 'required|string|size:6',
        ]);

        $user = Auth::user();

        if (! $user) {
            return redirect()->route('login');
        }

        if ($user->verification_code !== $this->code) {
            $this->addError('code', 'El código ingresado es incorrecto.');

            return;
        }

        if (now()->greaterThan($user->verification_code_expires_at)) {
            $this->addError('code', 'El código ha expirado. Por favor solicita uno nuevo.');

            return;
        }

        // Verify email
        $user->markEmailAsVerified();
        $user->verification_code = null;
        $user->verification_code_expires_at = null;
        $user->save();

        session()->flash('status', '¡Cuenta verificada exitosamente!');

        return redirect()->route('dashboard');
    }

    public function resendCode(): void
    {
        $user = Auth::user();

        if (! $user) {
            $this->redirectRoute('login');

            return;
        }

        if ($user->hasVerifiedEmail()) {
            $this->redirectRoute('dashboard');

            return;
        }

        $user->verification_code = sprintf('%06d', random_int(100000, 999999));
        $user->verification_code_expires_at = now()->addMinutes(60);
        $user->save();

        Mail::to($user->email)->send(new VerifyEmailOtpMail($user->name, $user->verification_code));

        $this->code = '';
        $this->resetValidation('code');
        $this->status = 'verification-code-sent';
    }

    public function render()
    {
        return view('livewire.modules.auth.pages.verify-otp');
    }
}
