<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('admin.auth.login');
    }

    public function postlogin(Request $request)
    {
        if (Auth::attempt($request->only('email', 'password'))) {
            if (Auth::user()->role == 'admin') {
                return redirect('/admin/dashboard');
            } else {
                Auth::logout();
                return redirect('/admin/login')->with('fail', 'Anda tidak memiliki akses');
            }
        }

        return redirect('/admin/login')->with('fail', 'Email atau password salah');
    }

    public function updateprofil(Request $request)
    {
        if ($request->password) {
            $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:users,email,' . Auth::user()->id,
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

            $user = User::find(Auth::user()->id);
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);
        } else {
            $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:users,email,' . Auth::user()->id,
            ], [
                'name.required' => 'Nama user harus diisi',
                'email.required' => 'Email user harus diisi',
                'email.email' => 'Email user harus valid',
                'email.unique' => 'Email user sudah terdaftar',
            ]);

            $user = User::find(Auth::user()->id);
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);
        }

        return redirect('/admin/profil')->with('update', 'Profil berhasil diubah');
    }

    public function profil()
    {
        return view('admin.auth.profil');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/admin/login');
    }
}
