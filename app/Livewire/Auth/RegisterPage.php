<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Livewire\Component;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterPage extends Component
{
    public $name = '';
    public $email = '';
    public $password = '';
    public $password_confirmation = '';
    public $passwordConfirmationTouched = false;
    public $showPassword = false;

    protected $rules = [
        'name' => 'required|min:3|unique:users,name|regex:/^(?! )[a-z\'’ ]+(?<! )$/',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:8|confirmed',
        'password_confirmation' => 'required|min:8'
    ];

    protected $messages = [
        'name.required' => 'Nama wajib diisi',
        'name.min' => 'Nama minimal 3 karakter',
        'email.required' => 'Email wajib diisi',
        'email.email' => 'Format email tidak valid',
        'email.unique' => 'Pendaftaran gagal, coba email lain',
        'name.unique' => 'Pendaftaran gagal, coba nama lain',
        'password.required' => 'Password wajib diisi',
        'password_confirmation.required' => 'Konfirmasi Password wajib diisi',
        'password.min' => 'Password minimal 8 karakter',
        'password_confirmation.min' => 'Konfirmasi Password minimal 8 karakter',
        'password.confirmed' => 'Konfirmasi password tidak cocok',
        'name.regex' => 'Nama hanya boleh mengandung huruf kecil, spasi ditengah, dan tanda kutip',
    ];

    public function updated($propertyName)
    {
        if ($propertyName === 'password_confirmation') {
            $this->passwordConfirmationTouched = true;
        }

        if (
            $this->passwordConfirmationTouched &&
            $this->password_confirmation !== '' &&
            $this->password !== $this->password_confirmation
        ) {
            $this->addError('password', 'Password harus sama dengan konfirmasi password');
        } else {
            $this->resetValidation('password');
        }

        $this->validateOnly($propertyName);
    }

    public function register()
    {
        $this->name = strtolower(trim($this->name));

        try {
            $validateData = $this->validate();
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Ambil pesan error pertama dan kirimkan ke Toastify
            $errorMessage = collect($e->validator->errors()->all())->first();
            // $this->dispatch('notify-error', ['message' => $errorMessage]);
            $this->dispatch('notify-error', message: $errorMessage);

            return;
        }

        if (
            User::whereRaw('LOWER(name) = ?', [strtolower($validateData['name'])])->exists() ||
            User::where('email', $validateData['email'])->exists()
        ) {
            $this->addError('name', 'Pendaftaran gagal, coba nama lain');
            $this->addError('email', 'Pendaftaran gagal, coba email lain');

            // Tampilkan error pertama dari validasi
            $this->dispatch('notify-error', ['message' => 'Pendaftaran gagal, coba nama atau email lain']);
            return;
        }

        $isFirstUser = User::count() === 0;

        $user = User::create([
            'name' => strtolower(trim($validateData['name'])),
            'email' => $validateData['email'],
            'password' => Hash::make($validateData['password']),
            'is_admin' => $isFirstUser
        ]);

        event(new Registered($user));
        Auth::login($user);

        // return redirect()->intended($isFirstUser ? '/admin' : route('home'));
        $this->redirectRoute('home');
        // return redirect()->route('home');
    }

    public function togglePassword()
    {
        $this->showPassword = !$this->showPassword;
    }

    public function render()
    {
        return view('livewire.auth.register-page');
    }
}
