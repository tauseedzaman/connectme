<?php

use App\Http\Controllers\ProfileController;
use App\Http\Livewire\Components\CreatePage;
use App\Http\Livewire\CreateGroup;
use App\Http\Livewire\Group;
use App\Http\Livewire\Groups;
use App\Http\Livewire\Home;
use App\Http\Livewire\Page;
use App\Http\Livewire\Pages;
use App\Http\Livewire\Peoples;
use App\Http\Livewire\Profile;
use App\Http\Livewire\Search;
use App\Http\Livewire\Settings\AccountInformaiton;
use App\Http\Livewire\Settings\Help;
use App\Http\Livewire\Settings\Notifications;
use App\Http\Livewire\Settings\PasswordUpdate;
use App\Http\Livewire\Settings\SavedPosts;
use App\Http\Livewire\Settings\Setting;
use App\Http\Livewire\Settings\Socials;
use App\Http\Livewire\SinglePost;
use App\Http\Livewire\Test;
// use App\Http\Livewire\Socials;
use App\Http\Livewire\User;
use App\Http\Livewire\VideoPosts;
use App\Models\Post;
use App\Models\User as ModelsUser;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Benchmark;
use Illuminate\Support\Env;
use Illuminate\Support\Facades\Route;






Route::middleware(["auth", "verified", 'VerifiedUser'])->group(function () {
    Route::get('/', Home::class)->name("home");
    Route::get('/videos', VideoPosts::class)->name("videos");
    Route::get('/pages', Pages::class)->name("pages");
    Route::get('/search', Search::class)->name("search");
    Route::get('/pages/{uuid}', Page::class)->name("page");
    Route::get('/page/create', CreatePage::class)->name("create-page");

    Route::get('/groups', Groups::class)->name("groups");
    Route::get('/groups/{uuid}', Group::class)->name("group");
    Route::get('/group/create', CreateGroup::class)->name("create-group");

    // Route::get('/profile/', Profile::class)->name("profile");
    Route::get('/user/{uuid}', User::class)->name("user");

    // users settings
    Route::prefix('user-profille')->group(function () {
        Route::get('/', Setting::class)->name("settings");
        Route::get('/settings', AccountInformaiton::class)->name("settings.account_information");
        Route::get('/saved-items', SavedPosts::class)->name("settings.saved_posts");
        Route::get('/socials', Socials::class)->name("settings.socials");
        Route::get('/reset-password', PasswordUpdate::class)->name("settings.password_update");
        Route::get('/notifcation', Notifications::class)->name("settings.notifications");
        Route::get('/help', Help::class)->name("settings.help");
    });

    Route::get('/explore', Peoples::class)->name("explore");
    Route::get('/post/{useruuid}/{postuuid}', SinglePost::class)->name("single-post");
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
