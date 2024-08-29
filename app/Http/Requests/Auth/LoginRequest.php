<?php

namespace App\Http\Requests\Auth;

use App\Models\User;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ];
    }

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function authenticate(): void
    {
        $this->ensureAccountIsNotLocked();
        if (! Auth::attempt($this->only('email', 'password'), $this->boolean('remember'))) {

            $emailToAuth = $this->only('email')['email'];
            $this->updateFailedAttemps($emailToAuth);

            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);
        }

        $this->resetLoginAttempts();
    }

    /**
     * Ensure the login request is not rate limited.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function ensureAccountIsNotLocked(): void
    {
        $email = $this->only('email')["email"];
        $user = User::where('email', $email)->first();
        if($user->failed_login_attempts < 5){
            return;
        }

        throw ValidationException::withMessages([
            'email' => 'Your account is blocked due to an big number of login attempts! Please contact an admin to unlock it!',
        ]);
    }

    private function updateFailedAttemps(): void{
        $email = $this->only('email')["email"];
        $user = User::where('email', $email)->first();
        
        if($user->failed_login_attempts == 5){
            $this->blockAccount($user);
        }

        $user->failed_login_attempts += 1;
        $user->save();
    }

    private function blockAccount(User $user): void{
        $user->account_locked = 1;
        $user->save();
        throw ValidationException::withMessages([
            'email' => 'Due to an exceeded number of attempts your account has ben blocked! Please contact an admin to unlock it!',
        ]);
    }

    private function resetLoginAttempts(){
        $email = $this->only('email')['email'];
        $user = User::where('email', $email)->first();
        $user->failed_login_attempts = 0;
        $user->save();
    }
}
