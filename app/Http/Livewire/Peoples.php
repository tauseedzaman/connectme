<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
class Peoples extends Component
{
    use WithPagination;
    public $paginator = 10;
    public $search;

    public function render()
    {
        $users = User::where("first_name", "like", "%" . $this->search . "%")
            ->inRandomOrder()
            ->paginate($this->paginator, ["uuid", "profile", "first_name", "last_name", "username"]);

        return view('livewire.peoples', [
            "users" => $users,
            "pagination" => $users->links()
        ])->extends("layouts.app");
    }
}
