<?php

namespace App\Http\Controllers;

use App\Models\LogAktivitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // cek apakah sudah login atau belum
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard.index');
        }

        return view('login');
    }

    // cek apakah email dan password sesuai atau belum
    public function actionLogin(Request $request)
    {
        $data = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($data)) {
            $request->session()->regenerate();
            LogAktivitas::catat('Login ke aplikasi');

            return redirect()->route('dashboard.index')->with('success', 'Login Berhasil');
        }

        return redirect()->route('login')
            ->withInput($request->only('email'))
            ->with('error', 'Login Gagal !, Email atau Password yang Anda masukkan salah');
    }

    // keluar dari aplikasi
    public function actionLogout(Request $request)
    {
        LogAktivitas::catat('Logout dari aplikasi');

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Anda Berhasil Logout');
    }
}
