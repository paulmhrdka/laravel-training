<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmailJob;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function show()
    {
        return view('auth.register', [
            'title' => 'Register',
            'active' => 'Register'
        ]);
    }

    public function store(Request $request)
    {
        $validateData =  $request->validate([
            'name' => 'required|min:3|max:255|unique:users',
            'email' => 'required|email:dns|unique:users',
            'password' => 'required|min:8',
            'birthdate' => 'date'
        ], [
            'name.required'     => 'Username tidak boleh kosong!',
            'name.min'          => 'Username harus diantara 3 - 255 karakter!',
            'name.max'          => 'Username harus diantara 3 - 255 karakter!',
            'name.unique'       => 'Username telah terdaftar!',
            'email.required'    => 'Email tidak boleh kosong!',
            'email.email'       => 'Email harus menggunakan format nama@example.com!',
            'password.required' => 'Password tidak boleh kosong!',
            'password.min'      => 'Password minimal 8 karakter!',
            'birthdate.date'    => 'Tanggal Lahir harus bertipe tanggal'
        ]);

        // check birthdate
        if ($validateData['birthdate'] > date("Y-m-d")) {
            return back()->withErrors(['birthdate' => 'Tanggal lahir tidak valid!'])->withInput();
        }

        // check confirm password
        if ($request['confirm-password'] != $validateData['password']) {
            return back()->withErrors(['confirm-password' => 'Password tidak sama!'])->withInput();
        }

        // use bcrypt
        // $validateData['password'] = bcrypt($validateData['password']);

        // use laravel Hash
        $validateData['password'] = Hash::make($validateData['password']);

        User::create($validateData);
        dispatch(new SendEmailJob($validateData['email']));

        return redirect('/login')->with('success', 'Registrasi Berhasil, Silahkan Login!');
    }
}
