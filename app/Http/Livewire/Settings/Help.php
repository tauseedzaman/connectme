<?php

namespace App\Http\Livewire\Settings;

use App\Models\Faq;
use Livewire\Component;

class Help extends Component
{
    public $paginate_no = 9;
    public $search;

    public $listeners = [
        "load-more" => 'LoadMore'
    ];

    public function LoadMore()
    {
        $this->paginate_no = $this->paginate_no + 3;
    }
    public function render()
    {
        return view('livewire.settings.help', [
            "data" => Faq::where("question", "LIKE", "%" . $this->search . "%")->latest()->paginate($this->paginate_no)
        ])->extends("layouts.app");
    }
}
