<?php

namespace App\Http\Livewire\Settings;

use Livewire\Component;

class Setting extends Component
{
    public function render()
    {
        return view('livewire.settings.setting')->extends("layouts.app");
    }
}
