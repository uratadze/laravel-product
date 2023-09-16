<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\LoginRequest;
use App\Http\Requests\User\RegisterRequest;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function register(RegisterRequest $request): RedirectResponse
    {
        $user = User::query()->create($request->validated());

        auth()->login($user);

        return redirect()->to('/');
    }

    public function registerForm(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('register');
    }

    public function login(LoginRequest $request): RedirectResponse
    {
        if (Auth::attempt($request->validated(), $request->has('remember')))
        {
            return redirect()->intended('/');
        }

        return back()->withErrors(['email' => 'Invalid credentials'])->withInput();
    }

    public function loginForm(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('login');
    }

    public function logout(): RedirectResponse
    {
        auth()->logout();

        return redirect()->to('/');
    }
}
