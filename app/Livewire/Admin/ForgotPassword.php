<?php

namespace App\Livewire\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Livewire\Component;
use Illuminate\Auth\Events\PasswordReset;

class ForgotPassword extends Component
{

    public $email = '';
     public $success = false;

    protected $rules = [
        'email' => 'required|min:4|max:256'
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function forgot(Request $request)
    {
        $status = Password::sendResetLink(
            ['email' => $this->email]
        );
        if ($status === Password::RESET_LINK_SENT) {
            $this->success = true;
            return $this->success;// redirect to dashboard or other route
        } else {
            session()->flash('error', 'Please try again');
        }
    }
    public function render()
    {
        return view('livewire.admin.forgot-password');
    }
}
