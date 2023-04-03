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
    public $hide_user_list = [];

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
                "status" => "pending"
            ])->first();
            $req->status = "accepted";
            $req->accepted_at=now();
            $req->save();
            Notification::create([
                "type" => "friend_accepted",
                "user_id" => $user->id,
                "message" => auth()->user()->username . " accepted your friend request",
                "url" => "#",
            ]);

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

    public function hide_all_from($type, $id)
    {
        if ($type == "user") {
            $friendship = Friend::where("user_id", $id)->orWhere("friend_id", $id)->first();
            if ($friendship) {
                $friendship->status = "rejected";
                $friendship->save();
            } else {
                $this->hide_user_list[] = $id;
            }
        } elseif ($type == "group") {
            $member = GroupMember::where(["group_id" => $id, "user_id" => auth()->id()])->first();
            if ($member) {
                $member->status = "inactive";
                $member->save();
            }
        } elseif ($type == "page") {
            $member = PageLike::where(["page_id" => $id, "user_id" => auth()->id()])->first();
            if ($member) {
                $member->delete();
            }
        }

        $this->dispatchBrowserEvent('alert', [
            "type" => "success", "message" =>  "Hide all from $type successfully.."
        ]);
    }

    public function render()
    {
        // dd(auth()->id());
        $my_pages = PageLike::where("user_id", auth()->id())->pluck("page_id");
        $my_groups = GroupMember::where("user_id", auth()->id())->pluck("group_id");
        $friend_ids = Friend::where(["user_id" => auth()->id()])->pluck("friend_id");



        // get posts algo
        $all_friends_aids = Friend::where(["user_id" => auth()->id(), "status" => "accepted"])->OrWhere(['friend_id' => auth()->id(), "status" => "accepted"])->get(["user_id", "friend_id"])->toArray();

        $filtered_friends_ids = [];
        foreach ($all_friends_aids as $item) {
            $filtered_friends_ids[] = ($item['user_id'] == auth()->id() ? $item['friend_id'] : $item['user_id']);
        }

            $random_users=User::inRandomOrder()->take(100)->pluck("id");
            // whereIn("group_id", $my_groups)->orWhereIn("user_id", $random_users)->OrwhereIn("user_id", $filtered_friends_ids)->OrWhereIn("page_id", $my_pages)->with(["user","page","group"])->
        $posts = Post::where("status","published")->latest()->paginate($this->paginate_no);


        return view('livewire.home', [
            'posts' => $posts,
            'friend_requests' => Friend::where(["friend_id" => auth()->id(), "status" => "pending"])->with("user")->latest()->take(5)->get(),
            'suggested_friends' => User::whereNotIn("id", $friend_ids)->inRandomOrder()->take(3)->get(),
            "suggested_pages" => Page::whereNotIn("id", $my_pages)->inRandomOrder()->take(3)->get(),
            "suggested_groups" => Group::whereNotIn("id", $my_groups)->inRandomOrder()->take(2)->get()
        ])->extends("layouts.app");
    }
}
        // Friend::where("user_id",101)->orWhere("friend_id",101)->where("status","accepted")->pluck("friend_id");
