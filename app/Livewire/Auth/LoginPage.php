<?php

namespace App\Livewire\Auth;

use App\Models\About;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;

class LoginPage extends Component
{
    public $name = '';
    public $password = '';
    public $showPassword = false;

    public $about;

    protected $rules = [
        'name' => 'required|min:3|regex:/^(?! )[a-z\'’ ]+(?<! )$/',
        'password' => 'required|min:8',
    ];

    protected $messages = [
        'name.required' => 'Nama wajib diisi',
        'name.min' => 'Nama minimal 3 karakter',
        'name.regex' => 'Nama hanya boleh mengandung huruf kecil, spasi ditengah, dan tanda kutip',
        'password.required' => 'Password wajib diisi',
        'password.min' => 'Password minimal 8 karakter'
    ];

    public function mount()
    {
        if (Auth::check()) {
            $this->redirectRoute('home');
        }

        $this->about = About::first();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function togglePassword()
    {
        $this->showPassword = !$this->showPassword;
    }

    public function login()
    {
        $this->validate();

        $throttleKey = strtolower($this->name) . '|' . request()->ip();

        if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
            $seconds = RateLimiter::availableIn($throttleKey);
            $this->dispatch('notify-error', message: "Terlalu banyak percobaan login. Coba lagi dalam {$seconds} detik.");
            return;
        }

        $name = strtolower(trim($this->name));
        $password = $this->password;

        if (Auth::attempt(['name' => $name, 'password' => $password])) {
            RateLimiter::clear($throttleKey); // reset count saat login berhasil
            session()->regenerate();

            $user = Auth::user();

            if ($user->roles->isNotEmpty()) {
                return redirect()->route('filament.admin.pages.dashboard');
            }

            return redirect()->intended(route('home'));
        }

        RateLimiter::hit($throttleKey, 60); // hit count, expire dalam 60 detik

        $this->password = '';
        $this->dispatch('notify-error', message: 'Nama atau password salah');
    }

    public function render()
    {
        return view('livewire.auth.login-page');
    }
}
