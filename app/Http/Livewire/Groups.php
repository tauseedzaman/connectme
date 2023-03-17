<?php

namespace App\Http\Livewire;

use App\Models\Group;
use App\Models\GroupMember;
use App\Models\Notification;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Groups extends Component
{
    public $paginator = 10;
    public $search;
    public $listeners = [
        "load-more" => 'LoadMore'
    ];

    public function LoadMore()
    {
        $this->paginator = $this->paginator + 4;
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

    public function leave($id)
    {
        $group = Group::findOrFail($id);
        DB::beginTransaction();
        try {
            $member = GroupMember::where([
                "user_id" => auth()->id(),
                "group_id" => $group->id
            ])->first();
            $group->members -= 1;
            $group->save();
            $member->delete();
            // Notification::create([
            //     "type" => "page_liked",
            //     "user_id" => $group->user_id,
            //     "message" => auth()->user()->username . " followed your page " . $group->name,
            //     "url" => "#",
            // ]);

            $this->dispatchBrowserEvent('alert', [
                "type" => "success", "message" =>  " you left " . $group->name
            ]);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }


    public function render()
    {
        return view('livewire.groups', [
            "groups" => Group::where("name","LIKE","%".$this->search."%")->orderBy("members")->paginate($this->paginator)
        ])->extends("layouts.app");
    }
}
