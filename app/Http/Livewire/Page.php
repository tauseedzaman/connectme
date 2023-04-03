<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use App\Models\Like;
use App\Models\Notification;
use App\Models\Page as ModelsPage;
use App\Models\PageLike;
use App\Models\Post;
use App\Models\PostMedia;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Page extends Component
{
    use WithPagination;
    public $uuid;
    // public $loader;

    public $paginate_no = 10;
    public $comment;
    public $listeners = [
        "load-more" => 'LoadMore'
    ];

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

    public function LoadMore()
    {
        $this->paginate_no = $this->paginate_no + 3;
    }

    // public function toggle()
    // {
    //     $this->loader=!$this->loader;
    // }

    public function saveComment($post_id)
    {
        $this->validate([
            "comment" => "required|string"
        ]);
        DB::beginTransaction();
        try {
            Comment::firstOrCreate([
                "post_id" => $post_id,
                "comment" => $this->comment,
                "user_id" => auth()->id()
            ]);
            $post = Post::findOrFail($post_id);
            $post->comments += 1;
            $post->save();
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
        unset($this->comment);
    }

    public function like($id)
    {
        DB::beginTransaction();
        try {
            Like::firstOrCreate(["post_id" => $id, "user_id" => auth()->id()]);
            $post = Post::findOrFail($id);
            $post->likes += 1;
            $post->save();
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }
    public function dislike($id)
    {
        DB::beginTransaction();
        try {
            $like = Like::where(["post_id" => $id, "user_id" => auth()->id()])->first();
            $like->delete();
            $post = Post::findOrFail($id);
            $post->likes -= 1;
            $post->save();
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    public function mount($uuid)
    {
        $this->uuid = $uuid;
    }

    public function render()
    {
        $page = ModelsPage::where("uuid", $this->uuid)->firstOrFail();
        $posts_ids = Post::where("page_id", $page->id)->where("status", "published")->pluck("id");
        $posts = Post::where("page_id", $page->id)->paginate($this->paginate_no);
        $post_media = PostMedia::whereIn("post_id", $posts_ids)->where("file_type", "image")->take(10);
        // dd($page);

        return view('livewire.page', [
            "posts" => $posts,
            "pagee" => $page,
            "post_media" => $post_media,
        ])->extends("layouts.app");
    }
}
