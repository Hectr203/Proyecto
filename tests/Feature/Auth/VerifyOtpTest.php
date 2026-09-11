<?php

namespace Tests\Feature\Auth;

use App\Core\Customers\Models\User;
use App\Livewire\Modules\Auth\Pages\VerifyOtp;
use App\Mail\Auth\VerifyEmailOtpMail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Livewire\Livewire;
use Tests\TestCase;

class VerifyOtpTest extends TestCase
{
    use RefreshDatabase;

    public function test_unverified_users_can_request_a_new_code(): void
    {
        $user = User::factory()->unverified()->create();

        Mail::fake();

        Livewire::actingAs($user)
            ->test(VerifyOtp::class)
            ->call('resendCode')
            ->assertSet('status', 'verification-code-sent');

        $user = $user->fresh();

        $this->assertMatchesRegularExpression('/^\d{6}$/', $user->verification_code);
        $this->assertNotNull($user->verification_code_expires_at);
        Mail::assertQueued(VerifyEmailOtpMail::class);
    }

    public function test_expired_code_can_be_replaced_with_a_new_code(): void
    {
        $user = User::factory()->unverified()->create([
            'verification_code' => '123456',
            'verification_code_expires_at' => now()->subMinute(),
        ]);

        Mail::fake();

        Livewire::actingAs($user)
            ->test(VerifyOtp::class)
            ->set('code', '123456')
            ->call('verify')
            ->assertHasErrors('code')
            ->call('resendCode');

        $this->assertNotSame('123456', $user->fresh()->verification_code);
        Mail::assertQueued(VerifyEmailOtpMail::class);
    }
}
