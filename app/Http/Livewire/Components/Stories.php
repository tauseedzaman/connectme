<?php

namespace App\Http\Livewire\Components;

use App\Models\Story;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;

class Stories extends Component
{
    use WithFileUploads;

    public $images;

    public function updatedImages()
    {
        // $this->validate([
        //     "images" => "required|image|mimes:png,jpg,jpeg"
        // ]);
        $images = [];
        foreach ($this->images as $image) {
            $images[] = $image->store("storeis", 'public');
        }

        Story::create([
            "user_id" => auth()->id(),
            "story" => json_encode($images),
            "status" => 1,
        ]);
        unset($this->images);
        return redirect("/");

    }

    public function render()
    {
        // have an algo which show me my friends stories
        return view('livewire.components.stories',[
            "stories"=>Story::where("created_at",">=",now()->subDay())->latest()->get()->unique("user_id")
        ]);
    }
}
