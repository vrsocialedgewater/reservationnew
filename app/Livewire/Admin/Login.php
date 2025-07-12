<?php

namespace App\Livewire\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{

    public $email = '';

    public $password = '';

    protected $rules = [
        'email' => 'required|min:4|max:256',
        'password' => 'required|min:6|max:64',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function login(Request $request)
    {
        $this->validate();

        if (Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
            $request->session()->regenerate();
            session()->flash('message', 'Login successful.');
            return redirect('/admin'); // redirect to dashboard or other route
        } else {
            session()->flash('error', 'Invalid credentials.');
        }

    }


    public function render()
    {
        return view('livewire.admin.login');
    }
}
