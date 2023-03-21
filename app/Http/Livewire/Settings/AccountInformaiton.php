<?php

namespace App\Http\Livewire\Settings;

use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;

class AccountInformaiton extends Component
{
    use WithFileUploads;
    public $first_name;
    public $last_name;
    public $username;
    public $email;
    public $mobile;
    public $address;
    public $country;
    public $profile;
    public $thumbnail;
    public $description;

    public function mount()
    {
        $this->first_name = auth()->user()->first_name;
        $this->last_name = auth()->user()->last_name;
        $this->username = auth()->user()->username;
        $this->email = auth()->user()->email;
        $this->mobile = auth()->user()->mobile;
        $this->address = auth()->user()->address;
        $this->country = auth()->user()->location;
        $this->description = auth()->user()->description;
    }

    public function updateProfile()
    {
        $this->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'profile' => 'required|image|mimes:png,jpg,jpeg|max:1024',
            'thumbnail' => 'required|image|mimes:png,jpg,jpeg|max:1024',
        ]);
        $user = User::find(auth()->id());
        $user->first_name = $this->first_name;
        $user->last_name = $this->last_name;
        $user->username = $this->username;
        $user->address = $this->address;
        $user->location = $this->country;
        $user->profile = $this->profile->store("profiles","public");
        $user->thumbnial = $this->thumbnail->store("profiles","public");
        $user->description = $this->description;
        $user->save();
        $this->dispatchBrowserEvent('alert', [
            "type" => "success", "message" =>  " Account Informaiton Updated successfully."
        ]);
        return redirect()->route("settings.account_information");
    }
    public function render()
    {
        return view('livewire.settings.account-informaiton')->extends("layouts.app");
    }
}
