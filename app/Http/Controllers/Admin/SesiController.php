<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Admin\User;
use Illuminate\Support\Facades\Hash;

class SesiController extends Controller
{
    // Tampilkan halaman login
    public function index()
    {
        return view('Admin.login'); // pastikan file resources/views/Admin/login.blade.php ada
    }

    // Proses login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ], [
            'email.required' => 'Email wajib diisi',
            'password.required' => 'Password wajib diisi',
        ]);

        $credentials = $request->only('email', 'password');

        // Coba login
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate(); // hindari session fixation

            // Redirect sesuai role
            if (Auth::user()->role === 'admin') {
                return redirect()->route('dashboard');
            } elseif (Auth::user()->role === 'customer') {
                return redirect()->route('homepage'); // pastikan route ini ada
            } else {
                Auth::logout();
                return back()->withErrors('Role user tidak dikenali');
            }
        }

        return back()->withErrors('Email atau Password salah')->withInput();
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    // Proses register (opsional)
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'customer',
        ]);

        Auth::login($user);

        return redirect()->route('dashboard'); // atau redirect ke halaman customer jika role customer
    }
}
