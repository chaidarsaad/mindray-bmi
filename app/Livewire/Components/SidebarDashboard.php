<?php

namespace App\Livewire\Components;

use Livewire\Component;

class SidebarDashboard extends Component
{
    public function logout()
    {
        auth()->logout();
        return redirect()->route('home');
    }
    public function render()
    {
        return view('livewire.components.sidebar-dashboard');
    }
}
