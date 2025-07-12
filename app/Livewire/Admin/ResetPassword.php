<?php

namespace App\Livewire\Admin;

use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Livewire\Component;

class ResetPassword extends Component
{
    public $email = '';

    public $password = '';

    public $password_confirmation = '';

    public $token = '';

    public $success = false;

    protected $rules = [
        'token' => 'required',
        'email' => 'required|min:4|max:256',
        'password' => 'required|min:6|max:64|confirmed'
    ];

    public function mount(Request $request, $token) {
        $this->email = request()->get('email');
        $this->token = $token;
    }


    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function resetPassword(Request $request)
    {
        $this->validate();
        $status = Password::reset(
            ['email' => $this->email, 'password' => $this->password, 'password_confirmation' => $this->password_confirmation, 'token' => $this->token],
            function ($user) use ($request) {
                $user->forceFill([
                    'password' => Hash::make($this->password),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        if ($status == Password::PASSWORD_RESET) {
            $this->success = true;
            return $this->success;
        } else {
            session()->flash('error', 'Invalid credentials.');
        }
    }

    public function render()
    {
        return view('livewire.admin.reset-password');
    }
}
