<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function index()
    {
        return view('admin\sig-in');
    }
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => ['required', 'min:3', 'regex:/[A-Z]/'],
        ], [
            'username.required' => 'Username tidak boleh kosong',
            'password.required' => 'Password tidak boleh kosong',
            'password.min' => 'Password minimal tiga karakter',
            'password.regex' => 'Password wajib mengandung minimal satu huruf kapital'
        ]);

        if ($request->username === $request->password) {
            return redirect()->route('dashboard')
                ->with('success', 'Selamat datang Admin!');
        } else {
            return redirect()->route('auth.index')
                ->with('error', 'Username dan password harus sama.');
        }
    }

    public function register(Request $request)
    {
        $request->validate([
            'nama' => ['required', 'regex:/^[^0-9]+$/'],
            'alamat' => 'required|max:300',
            'username' => 'required',
            'password' => [
                'required',
                'regex:/[A-Z]/',
                'regex:/[0-9]/'
            ],
            'confirm' => 'required|same:password',
        ], [
            'nama.regex' => 'Nama tidak boleh mengandung angka.',
            'alamat.max' => 'Alamat maksimal 300 karakter.',
            'password.regex' => 'Password harus mengandung huruf besar dan angka.',
            'confirm.same' => 'Password dan konfirmasi password tidak sama.',
        ]);
        if ($request->password === $request->confirm) {
            return redirect()->route('logvolt')
                ->with('success', 'Registrasi Berhasil! Silahkan Login Kembali');
        } else {
            return redirect()->route('regisvolt')
                ->with('error', 'Username dan password harus sama.');
        }
    }
}
