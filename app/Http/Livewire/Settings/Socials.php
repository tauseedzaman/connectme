<?php

namespace App\Http\Livewire\Settings;

use App\Models\Socials as ModelsSocials;
use Livewire\Component;

class Socials extends Component
{
    public $Facebook;
    public $Twitter;
    public $Linkedin;
    public $Instagram;
    public $Flickr;
    public $Github;
    public $Skype;
    public $Google;


    public function mount()
    {
        $data = ModelsSocials::where("user_id", auth()->id())->first();
        if ($data) {
            $this->Facebook = $data->Facebook;
            $this->Twitter = $data->Twitter;
            $this->Linkedin = $data->Linkedin;
            $this->Instagram = $data->Instagram;
            $this->Flickr = $data->Flickr;
            $this->Github = $data->Github;
            $this->Skype = $data->Skype;
            $this->Google = $data->Google;
        }
    }

    public function save()
    {
        $this->validate([
            "Facebook" => "sometimes|url",
            "Twitter" => "sometimes|url",
            "Linkedin" => "sometimes|url",
            "Instagram" => "sometimes|url",
            "Flickr" => "sometimes|url",
            "Github" => "sometimes|url",
            "Skype" => "sometimes|url",
            "Google" => "sometimes|url",
        ]);
        ModelsSocials::create([
            "user_id"=>auth()->id(),
            "Facebook" => $this->Facebook,
            "Twitter" => $this->Twitter,
            "Linkedin" => $this->Linkedin,
            "Instagram" => $this->Instagram,
            "Flickr" => $this->Flickr,
            "Github" => $this->Github,
            "Skype" => $this->Skype,
            "Google" => $this->Google,
        ]);

        $this->dispatchBrowserEvent('alert', [
            "type" => "success", "message" =>  "Saved.."
        ]);
    }
    public function render()
    {
        return view('livewire.settings.socials')->extends("layouts.app");
    }
}
