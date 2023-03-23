<?php

namespace App\Http\Livewire\Settings;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Setting extends Component
{

    public function logout()
    {
        Auth::guard('web')->logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();

        return redirect('/');
    }
    public function render()
    {
        return view('livewire.settings.setting')->extends("layouts.app");
    }
}
