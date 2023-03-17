<?php

namespace App\Http\Livewire;

use App\Models\Notification;
use App\Models\Page;
use App\Models\PageLike;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Pages extends Component
{
    use WithPagination;
    public $paginator = 12;
    public $search = '';

    public $listeners = [
        "load-more" => 'LoadMore'
    ];

    public function LoadMore()
    {
        $this->paginator = $this->paginator + 6;
    }

    public function follow($id)
    {
        $page = Page::findOrFail($id);
        DB::beginTransaction();
        try {


            PageLike::create([
                "user_id" => auth()->id(),
                "page_id" => $page->id
            ]);
            $page->members += 1;
            $page->save();
            Notification::create([
                "type" => "page_liked",
                "user_id" => $page->user_id,
                "message" => auth()->user()->username . " followed your page " . $page->name,
                "url" => "#",
            ]);

            $this->dispatchBrowserEvent('alert', [
                "type" => "success", "message" =>  " you followed " . $page->name
            ]);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    public function ulfollow($id)
    {
        $page = Page::findOrFail($id);
        DB::beginTransaction();
        try {
            $like = PageLike::where([
                "user_id" => auth()->id(),
                "page_id" => $page->id
            ])->first();
            $page->members -= 1;
            $page->save();
            $like->delete();
            // Notification::create([
            //     "type" => "page_liked",
            //     "user_id" => $page->user_id,
            //     "message" => auth()->user()->username . " followed your page " . $page->name,
            //     "url" => "#",
            // ]);

            $this->dispatchBrowserEvent('alert', [
                "type" => "success", "message" =>  " you unfollowed " . $page->name
            ]);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }
    public function render()
    {
        return view('livewire.pages', [
            "pages" => Page::where('name', 'like', '%' . $this->search . '%')->orderBy("members")->paginate($this->paginator)
        ])->extends("layouts.app");
    }
}
