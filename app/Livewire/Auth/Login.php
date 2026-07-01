<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('components.layouts.guest')]
#[Title('Login - Equogreen')]
class Login extends Component
{
    public $username = '';
    public $password = '';

    public function login()
    {
        $this->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // 1. Tentukan apakah input username berupa email atau username biasa
        $loginField = filter_var($this->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        $credentials = ['password' => $this->password];

        if ($loginField === 'email') {
            // Cari akun user (tabel 'akun') yang memiliki relasi email terdaftar
            // Baik di tabel 'procurement' (kolom email) atau 'vendor' (kolom email_perusahaan)
            $user = \App\Models\User::whereHas('procurement', function ($query) {
                $query->where('email', $this->username);
            })->orWhereHas('vendor', function ($query) {
                $query->where('email_perusahaan', $this->username);
            })->first();

            if ($user && \Illuminate\Support\Facades\Hash::check($this->password, $user->password)) {
                Auth::login($user);
                $loginSuccess = true;
            } else {
                $loginSuccess = false;
            }
        } else {
            // Login standard menggunakan username
            $credentials['username'] = $this->username;
            $loginSuccess = Auth::attempt($credentials);
        }

        if ($loginSuccess) {
            session()->regenerate();
            $user = Auth::user();

            $role = strtolower($user->role);
            if ($role === 'procurement' || $role === 'superadmin') {
                return redirect()->intended(route('procurement-dashboard'));
            }

            return redirect()->intended(route('vendor-dashboard'));
        }

        $this->addError('username', 'Username, email, atau password salah.');
    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}
