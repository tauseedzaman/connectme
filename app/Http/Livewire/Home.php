<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use App\Models\Friend;
use App\Models\Group;
use App\Models\GroupMember;
use App\Models\Like;
use App\Models\Notification;
use App\Models\Page;
use App\Models\PageLike;
use App\Models\Post;
use App\Models\SavedPost;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Home extends Component
{
    public $paginate_no = 9;
    public $comment;

    public $listeners = [
        "load-more" => 'LoadMore'
    ];

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

    public function acceptfriend($id)
    {
        $user = User::where("id", $id)->first();

        DB::beginTransaction();
        try {
            $req = Friend::where([
                "user_id" => $id,
                "friend_id" => auth()->id(),
            ])->first();
            $req->status = "accepted";
            $req->save();
            Notification::create([
                "type" => "friend_accepted",
                "user_id" => $user->id,
                "message" => auth()->user()->username . " accepted your friend request",
                "url" => "#",
            ]);

            // Notification::create([
            //     "type" => "friend_accepted",
            //     "user_id" => $user->id,
            //     "message" => " accepted your friend request" . $user->username,
            //     "url" => "#",
            // ]);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
        $this->dispatchBrowserEvent('alert', [
            "type" => "success", "message" =>  "  friend request accepted "
        ]);
    }

    public function rejectfriend($id)
    {
        $user = User::where("id", $id)->first();

        DB::beginTransaction();
        try {
            $req = Friend::where([
                "user_id" => $id,
                "friend_id" => auth()->id(),
            ])->first();
            $req->status = "rejected";
            $req->save();
            Notification::create([
                "type" => "friend_rejected",
                "user_id" => $user->id,
                "message" => auth()->user()->username . " rejected your friend request",
                "url" => "#",
            ]);

            // Notification::create([
            //     "type" => "friend_accepted",
            //     "user_id" => $user->id,
            //     "message" => " accepted your friend request" . $user->username,
            //     "url" => "#",
            // ]);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
        $this->dispatchBrowserEvent('alert', [
            "type" => "success", "message" =>  "  friend request rejected "
        ]);
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
            return redirect()->route("page", $page->uuid);
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    public function join($id)
    {
        $group = Group::findOrFail($id);
        DB::beginTransaction();
        try {


            GroupMember::create([
                "user_id" => auth()->id(),
                "group_id" => $group->id
            ]);
            $group->members += 1;
            $group->save();
            Notification::create([
                "type" => "page_liked",
                "user_id" => $group->user_id,
                "message" => auth()->user()->username . " joined your group " . $group->name,
                "url" => "#",
            ]);

            $this->dispatchBrowserEvent('alert', [
                "type" => "success", "message" =>  " you joined " . $group->name
            ]);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    public function save($post_id)
    {
        SavedPost::firstOrCreate([
            "user_id" => auth()->id(),
            "post_id" => $post_id
        ]);

        $this->dispatchBrowserEvent('alert', [
            "type" => "success", "message" =>  "Item Saved"
        ]);
    }

    public function render()
    {
        $my_pages = PageLike::where("user_id", auth()->id())->pluck("page_id");
        $my_groups = GroupMember::where("user_id", auth()->id())->pluck("group_id");
        return view('livewire.home', [
            'posts' => Post::with("user")->latest()->paginate($this->paginate_no),
            'friend_requests' => Friend::where(["friend_id" => auth()->id(), "status" => "pending"])->with("user")->latest()->take(5)->get(),
            "suggested_pages" => Page::whereNotIn("id", $my_pages)->inRandomOrder()->take(3)->get(),
            "suggested_groups" => Group::whereNotIn("id", $my_groups)->inRandomOrder()->take(2)->get()
        ])->extends("layouts.app");
    }
}
