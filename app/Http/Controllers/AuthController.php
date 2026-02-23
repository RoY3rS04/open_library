<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterUser;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function create(Request $request): View {
        return view('auth.register');
    }

    public function store(RegisterUser $request): RedirectResponse {

        $validated = $request->validated();

        $user = User::create([
            'username' => $validated['username'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect('/login');
    }

    public function loginView(Request $request): View {
        return view('auth.login');
    }

    public function login(LoginRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $user = User::where('email', $validated['email'])->first();

        if(! Hash::check($validated['password'], $user->password)) {
            return back()->withErrors([
                'msg' => 'The provided credentials do not match our records.',
            ]);
        }

        Auth::login($user);

        return redirect('/');
    }

    public function logout(): RedirectResponse {
        Auth::logout();
    }
}
