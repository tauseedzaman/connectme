<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class SinglePost extends Component
{
    public $user_uuid;
    public $post_uuid;
    public $comment;

    public function mount($useruuid, $postuuid)
    {
        $this->user_uuid = $useruuid;
        $this->post_uuid = $postuuid;
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
                "user_id" => auth()->id(),
                'status' => "pending"
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
    public function render()
    {
        $user = User::where("uuid", $this->user_uuid)->first();
        $post = Post::where(["user_id" => $user->id, 'uuid' => $this->post_uuid])->with(["user", 'commentss' => function ($query) {
            $query->where('status', 'published');
        }])->first();
        return view('livewire.single-post', [
            'post' => $post
        ])->extends("layouts.app");
    }
}
