<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;


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
            return redirect('/')->with('login', 'Login berhasil');
        }

        return redirect()->back()->with('loginerror', 'Email atau password salah');
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

        return redirect('/user/login')->with('register', 'Registrasi berhasil, silahkan login');
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

        return redirect('/user/profil')->with('updateprofil', 'Profil berhasil diupdate');
    }

    public function profil()
    {
        return view('user.auth.profil');
    }

    public function logout()
    {
        auth()->logout();
        return redirect('/')->with('logout', 'Logout berhasil');
    }

    public function linkresetpassword()
    {
        return view('user.auth.reset-password');
    }

    public function changepassword($code)
    {
        $user = User::where('code', $code)->where('status_code', 'aktif')->where('role', 'user')->first();
        if ($user) {
            return view('user.auth.change-password', [
                'user' => $user,
            ]);
        } else {
            return redirect('/')->with('linkkadaluarsa', 'Reset Password Gagal');
        }
    }

    public function changepasswordpost(Request $request)
    {
        $user = User::where('code', $request->code)->where('status_code', 'aktif')->where('role', 'user')->first();
        $request->validate([
            'password' => 'required',
            'repassword' => 'required|same:password',
        ], [
            'password.required' => 'Password tidak boleh kosong',
            'repassword.required' => 'Re-Password tidak boleh kosong',
            'repassword.same' => 'Re-Password tidak sama dengan Password',
        ]);

        $user->password = bcrypt($request->password);
        $user->code = null;
        $user->status_code = "tidak_aktif";
        $user->save();

        return redirect('/')->with('resetpasswordberhasil', 'Reset Password Berhasil');
    }

    public function sendlinkresetpassword(Request $request)
    {
        $request->validate([
            'email' => ['required'],
        ], [
            'email.required' => 'Email tidak boleh kosong',
        ]);

        $user = User::where('email', $request->email)->where('role', 'user')->first();

        if ($user) {
            try {
                $mail = new PHPMailer(true);

                //Server settings
                $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host       = 'monza.id.domainesia.com';                     //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $mail->Username   = 'rentcar@kaliansenang.my.id';                     //SMTP username
                $mail->Password   = 'Gituajamarah#23';                               //SMTP password
                $mail->SMTPSecure = 'ssl';            //Enable implicit TLS encryption
                $mail->Port       = 465;
                //Recipients
                $mail->setFrom('rentcar@kaliansenang.my.id', 'Pemesanan Makanan');
                $mail->addAddress($request->email);     //Add a recipient

                $Code = substr((str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ")), 0, 10);

                //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = 'Password Reset';
                $mail->Body    = 'To reset your password, please click the link below:<br><br><a href="http://127.0.0.1:8000/user/change-password/' . $Code . '">Reset Password</a>';
                $updatecode = User::where('email', '=', $request->email)->first();
                $updatecode->code = $Code;
                $updatecode->status_code = 'aktif';
                $updatecode->save();

                $mail->send();

                return redirect('/user/reset-password')->with('linkresetdikirim', 'Link reset password telah dikirim ke email');
            } catch (Exception $e) {
            }
        } else {
            return redirect()->back()->with('emailtidakditemukan', 'Email tidak ditemukan');
        }
    }
}
