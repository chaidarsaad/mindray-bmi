<?php

namespace App\Livewire\Auth;

use App\Models\About;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

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
        try {
            $this->validate();
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Ambil pesan error pertama dan kirimkan ke Toastify
            $errorMessage = collect($e->validator->errors()->all())->first();
            // $this->dispatch('notify-error', ['message' => $errorMessage]);
            $this->dispatch('notify-error', message: $errorMessage);

            return;
        }

        $name = strtolower(trim($this->name));
        $password = $this->password;

        if (Auth::attempt(['name' => $name, 'password' => $password])) {
            session()->regenerate();

            $user = Auth::user();

            if ($user->roles->isNotEmpty()) {
                return redirect()->route('filament.admin.pages.dashboard');
            }

            return redirect()->intended(route('home'));
        }

        $this->password = '';
        $this->dispatch('notify-error', message: 'Nama atau password salah');
    }
    public function render()
    {
        return view('livewire.auth.login-page');
    }
}
