<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Test extends Component
{
    public function render()
    {
        dd("this is a livewire component");
        return view('livewire.test');
    }
}
