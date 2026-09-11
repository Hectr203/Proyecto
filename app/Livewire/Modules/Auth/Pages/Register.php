<?php

namespace App\Livewire\Modules\Auth\Pages;

use App\Core\Customers\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.guest')]
class Register extends Component
{
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $validated['role'] = 'cliente';
        $validated['verification_code'] = sprintf('%06d', mt_rand(100000, 999999));
        $validated['verification_code_expires_at'] = now()->addMinutes(60);

        $user = User::create($validated);

        \Illuminate\Support\Facades\Mail::to($user->email)->send(new \App\Mail\Auth\VerifyEmailOtpMail($user->name, $user->verification_code));

        Auth::login($user);

        $this->redirect(route('verification.notice', absolute: false), navigate: true);
    }

    public function render()
    {
        return view('modules.Auth.pages.register');
    }
}
