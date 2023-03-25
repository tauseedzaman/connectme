<?php

namespace App\Http\Livewire\Components;

use App\Models\Notification;
use App\Models\Page;
use App\Models\PageLike;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;
use Str;

class CreatePage extends Component
{

    use WithFileUploads;
    public $name;
    public $location;
    public $type;
    public $icon;
    public $thumbnail;
    public $description;


    public function createpage()
    {
        $this->validate([
            "name" => "required|string",
            "location" => "required|string",
            "type" => "required|string",
            "icon" => "required|image",
            "thumbnail" => "required|image",
            "description" => "required|string",
        ]);

        DB::beginTransaction();
        try {
            $page = Page::create([
                "uuid" => Str::uuid(),
                "user_id" => auth()->id(),
                "icon" => $this->icon->store("pages", "public"),
                "thumbnail" => $this->thumbnail->store("pages", "public"),
                "description" => $this->description,
                "name" => $this->name,
                "location" => $this->location,
                "type" => $this->type
            ]);
            PageLike::create([
                "user_id" => auth()->id(),
                "page_id" => $page->id
            ]);

            Notification::create([
                "type" => "create_page",
                "user_id" => auth()->id(),
                "message" => $page->name . " page his been created successfully.",
                "url" => route("page", $page->uuid),
            ]);

            $this->dispatchBrowserEvent('alert', [
                "type" => "success", "message" =>  $page->name . " page  his been created successfully."
            ]);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }

        return to_route("page", $page->uuid);
    }

    public function render()
    {
        return view('livewire.components.create-page')->extends("layouts.app");
    }
}
