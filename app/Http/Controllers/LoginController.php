<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    public function show()
    {
        return view('auth.login', [
            'title' => 'Login',
            'active' => 'Login'
        ]);
    }

    public function store(Request $request)
    {
        $credentials = $request->validate([
            'email'     => 'required|email:dns',
            'password'  => 'required|min:8',
        ], [
            'email.required'    => 'email tidak boleh kosong!',
            'email.email'       => 'email harus berformat email!',
            'password.required' => 'password tidak boleh kosong!',
            'password.min'      => 'password harus minimal 8 karakter!',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        return back()->with('error', 'Email / Password salah!');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerate();

        return redirect('/login')->with('success', 'Berhasil Logout!');
    }

    public function githubRedirect()
    {
        return Socialite::driver('github')->redirect();
    }

    public function githubLogin()
    {
        $githubUser = Socialite::driver('github')->user();

        $user = User::firstOrCreate([
            'github_id' => $githubUser->id,
        ], [
            'name' => $githubUser->name,
            'email' => $githubUser->email,
            'password' => Hash::make($githubUser->id),
        ]);

        Auth::login($user);

        return redirect('/');
    }
}
