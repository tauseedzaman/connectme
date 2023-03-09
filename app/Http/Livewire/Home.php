<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;

class Home extends Component
{
    public $paginate_no=20;
    public function render()
    {
        return view('livewire.home',[
            'posts'=>Post::with("user")->latest()->paginate($this->paginate_no)
        ])->extends("layouts.app");
    }
}
