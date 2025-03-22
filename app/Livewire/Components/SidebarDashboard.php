<?php

namespace App\Livewire\Components;

use Illuminate\Support\Facades\Session;
use Livewire\Component;

class SidebarDashboard extends Component
{
    public function logout()
    {
        auth()->logout();
        Session::flush();
        return redirect()->route('home');
    }
    public function render()
    {
        return view('livewire.components.sidebar-dashboard');
    }
}
