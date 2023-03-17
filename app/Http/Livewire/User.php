<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use App\Models\Like;
use App\Models\Post;
use App\Models\PostMedia;
use App\Models\User as ModelsUser;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class User extends Component
{
    public $uuid;
    public $loader;

    public $paginate_no = 20;
    public $comment;
    public $listeners = [
        "load-more" => 'LoadMore'
    ];

    public function LoadMore()
    {
        $this->paginate_no = $this->paginate_no + 3;
    }

    public function toggle()
    {
        $this->loader=!$this->loader;
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

    public function mount($uuid)
    {
        $this->uuid = $uuid;
        $this->loader = 1;
    }

    public function render()
    {
        $user = ModelsUser::where("uuid", $this->uuid)->firstOrFail();
        $posts_ids = Post::where("user_id", $user->id)->pluck("id");
        if ($this->loader == 1) {
            $posts = Post::where("user_id", $user->id)->get();
            $post_media = PostMedia::whereIn("post_id", $posts_ids)->where("file_type", "image")->get();
            return view('livewire.user', [
                "user" => $user,
                "posts" => $posts,
                "post_media" => $post_media
            ])->extends("layouts.app");
        } else {
            $posts_media = PostMedia::whereIn("post_id", $posts_ids)->pluck("post_id");
            return view('livewire.user-media', [
                "user" => $user,
                "posts" => Post::whereIn("id", $posts_media)->get(),
            ])->extends("layouts.app");
        }
    }
}
