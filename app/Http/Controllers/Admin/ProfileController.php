<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{

    public function index(Request $request): View
    {
        $user = Auth::user();
        return view('admin.profile.index', compact('user'));
    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $user = Auth::user();
        return view('admin.profile.edit', compact('user'));
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = Auth::user();
        $request->user()->fill($request->validated());

        $user->update([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
        ]);
        session()->flash('message', 'Profile Updated Successfully.');
        return Redirect::route('admin.profile.edit');
    }

    public function changePassword(Request $request): View
    {
        return view('admin.profile.change-password');
    }

    public function updatePassword(Request $request): RedirectResponse
    {

        $request->validate([
            'old_password' => 'required|min:8|max:64',
            'password' => 'required|min:8|max:64|confirmed'
        ]);


        if(!(Hash::check($request->old_password, auth()->user()->password)))
            return redirect()->back()->withInput($request->all())->withErrors(['old_password' => 'Old password does not match.']);


        auth()->user()->update(['password' => Hash::make($request->password)]);

        session()->flash('message', 'Password updated Successfully.');
        return Redirect::route('admin.profile.change-password');
    }
}
