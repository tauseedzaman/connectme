<?php

namespace App\Http\Livewire\Settings;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Password;

class PasswordUpdate extends Component
{

    public $existing_password;
    public $password;
    public $password_confirmation;

    public function save()
    {
        $this->validate([
            "existing_password" => "required",
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::findOrFail(auth()->id());
        if (Hash::check($this->existing_password, $user->password)) {
            DB::beginTransaction();
            try {
                $user->password = Hash::make($this->password);
                $user->save();
                Notification::create([
                    "type" => "password_update",
                    "user_id" => auth()->id(),
                    "url"=>"#",
                    "message" => "Your Password his been updated"
                ]);
                $this->dispatchBrowserEvent('alert', [
                    "type" => "success", "message" =>  "Your Password his been updated.."
                ]);
                unset($this->existing_password);
                unset($this->password);
                unset($this->password_confirmation);

                DB::commit();
            } catch (\Throwable $th) {
                DB::rollBack();
                throw $th;
            }
        } else {
            return $this->dispatchBrowserEvent('alert', [
                "type" => "success", "message" =>  "Incorrect Existing Password"
            ]);
        }
    }
    public function render()
    {
        return view('livewire.settings.password-update')->extends("layouts.app");
    }
}
