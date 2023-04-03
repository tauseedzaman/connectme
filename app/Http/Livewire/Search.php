<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use App\Models\Like;
use App\Models\Post;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Search extends Component
{

    public $search;

    public $paginate_no = 9;
    public $comment;
    public $hide_user_list = [];

    public $listeners = [
        "load-more" => 'LoadMore'
    ];

    use WithPagination;
    public function LoadMore()
    {
        $this->paginate_no = $this->paginate_no + 3;
    }

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
    public function mount()
    {
        $this->search = request()->get("query");
    }
    public function render()
    {
        $posts = Post::where("content", "like", "%" . $this->search . "%")->paginate($this->paginate_no);
        return view('livewire.search', [
            "posts" => $posts
        ])->extends("layouts.app");
    }
}
