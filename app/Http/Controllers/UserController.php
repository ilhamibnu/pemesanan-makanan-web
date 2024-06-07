<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $user = User::where('role', 'user')->get();
        return view('admin.pages.user', [
            'user' => $user,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
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

        return redirect('/admin/user')->with('store', 'User berhasil ditambahkan');
    }

    public function edit(Request $request, $id)
    {
        if ($request->password) {
            $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:users,email,' . $id,
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

            User::where('id', $id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);
        } else {
            $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:users,email,' . $id,
            ], [
                'name.required' => 'Nama user harus diisi',
                'email.required' => 'Email user harus diisi',
                'email.email' => 'Email user harus valid',
                'email.unique' => 'Email user sudah terdaftar',
            ]);

            User::where('id', $id)->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);
        }

        return redirect('/admin/user')->with('update', 'User berhasil diubah');
    }

    public function destroy($id)
    {
        // cek apakah user ini memiliki cart
        $user = User::find($id);
        if ($user->cart->count() > 0) {
            foreach ($user->cart as $cart) {
                $cart->delete();
            }
        }

        // cek apakah user ini memiliki transaksi
        if ($user->transaction->count() > 0) {
            foreach ($user->transaksi as $transaction) {
                $transaction->delete();
            }
        }

        User::destroy($id);
        return redirect('/admin/user')->with('destroy', 'User berhasil dihapus');
    }
}
