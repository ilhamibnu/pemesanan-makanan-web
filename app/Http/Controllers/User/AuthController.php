<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class AuthController extends Controller
{
    public function login()
    {
        return view('user.auth.login');
    }

    public function register()
    {
        return view('user.auth.register');
    }

    public function loginPost(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'Email harus diisi',
            'email.email' => 'Email tidak valid',
            'password.required' => 'Password harus diisi',
        ]);

        $credentials = $request->only('email', 'password');
        if (auth()->attempt($credentials)) {
            return redirect('/')->with('success', 'Login berhasil');
        }

        return redirect()->back()->with('error', 'Email atau password salah');
    }

    public function registerPost(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'repassword' => 'required|same:password',
        ], [
            'name.required' => 'Nama user harus diisi',
            'email.required' => 'Email user harus diisi',
            'email.email' => 'Email user harus valid',
            'email.unique' => 'Email user sudah terdaftar',
            'password.required' => 'Password user harus diisi',
            'password.min' => 'Password user minimal 6 karakter',
            'repassword.required' => 'Konfirmasi password user harus diisi',
            'repassword.same' => 'Konfirmasi password user tidak sama dengan password',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'user',
        ]);

        return redirect('/user/login')->with('success', 'Registrasi berhasil, silahkan login');
    }

    public function updateprofil(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . auth()->user()->id,
            'password' => 'nullable|min:6',
            'repassword' => 'nullable|same:password',
        ], [
            'name.required' => 'Nama user harus diisi',
            'email.required' => 'Email user harus diisi',
            'email.email' => 'Email user harus valid',
            'email.unique' => 'Email user sudah terdaftar',
            'password.min' => 'Password user minimal 6 karakter',
            'repassword.same' => 'Konfirmasi password user tidak sama dengan password',
        ]);

        $user = User::find(auth()->user()->id);
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->password) {
            $user->password = bcrypt($request->password);
        }
        $user->save();

        return redirect('/user/profil')->with('success', 'Profil berhasil diupdate');
    }

    public function logout()
    {
        auth()->logout();
        return redirect('/')->with('success', 'Logout berhasil');
    }
}
