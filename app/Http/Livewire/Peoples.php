<?php

namespace App\Http\Livewire;

use App\Models\Friend;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Peoples extends Component
{
    use WithPagination;
    public $paginator = 10;
    public $search;

    public $listeners = [
        "load-more" => 'LoadMore'
    ];

    public function LoadMore()
    {
        $this->paginator = $this->paginator +8;
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
    public function addfriend($id)
    {
        $user = User::where("uuid", $id)->first();

        DB::beginTransaction();
        try {
            Friend::create([
                "user_id" => auth()->id(),
                "friend_id" => $user->id,
            ]);
            Notification::create([
                "type" => "friend_request",
                "user_id" => $user->id,
                "message" => auth()->user()->username . " send you friend request",
                "url" => "#",
            ]);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
        $this->dispatchBrowserEvent('alert', [
            "type" => "success", "message" => "friend request send to " . $user->username
        ]);
    }
    public function removefriend($id)
    {
        $user = User::where("uuid", $id)->first();

        DB::beginTransaction();
        try {
            Friend::where([
                "user_id" => auth()->id(),
                "friend_id" => $user->id,
            ])->first()->delete();
            Notification::create([
                "type" => "friend_request",
                "user_id" => $user->id,
                "message" => auth()->user()->username . " canceled friend request",
                "url" => "#",
            ]);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
        $this->dispatchBrowserEvent('alert', [
            "type" => "success", "message" => "friend request canceled from " . $user->username
        ]);
    }



    public function render()
    {
        $users = User::whereNotIn('id', [auth()->id()])->where("username", "like", "%" . $this->search . "%")
            ->inRandomOrder()
            ->paginate($this->paginator, ["id", "uuid", "profile", "first_name", "last_name", "username"]);

        return view('livewire.peoples', [
            "users" => $users,
            "pagination" => $users->links()
        ])->extends("layouts.app");
    }
}
