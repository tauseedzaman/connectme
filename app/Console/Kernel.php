<?php

namespace App\Console;

use App\Models\Comment;
use App\Models\Notification;
use App\Models\Post;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Http;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->call(function () {

            $posts = Post::where("status", "pending")->get();
            foreach ($posts as $post) {
                $collection = Http::withHeaders([
                    "content-type" => "text/plain",
                    "apiKey" => env("BAD_WORDS_API")
                ])->post('https://api.apilayer.com/bad_words', [
                    $post->content
                ])->collect();
                if ($collection["bad_words_total"] > 0) {
                    $post->status = "rejected";
                    echo "rejected";
                    $post->save();
                    Notification::create([
                        "user_id" => $post->user_id,
                        "type" => "post_status",
                        "message" => "Your Post his been rejected due to community guide lines",
                        "url" => "#",
                    ]);
                } else {
                    $post->status = "published";
                    echo "published";
                    $post->save();
                    Notification::create([
                        "user_id" => $post->user_id,
                        "type" => "post_status",
                        "message" => "Your Post his been published",
                        "url" => route("single-post", ["useruuid" => $post->user->uuid, "postuuid" => $post->uuid]),
                    ]);
                }
            }


            $comments = Comment::where("status", "pending")->get();
            foreach ($comments as $comment) {
                $collection = Http::withHeaders([
                    "content-type" => "text/plain",
                    "apiKey" => env("BAD_WORDS_API")
                ])->post('https://api.apilayer.com/bad_words', [
                    $comment->content
                ])->collect();

                if ($collection["bad_words_total"] > 0) {
                    $comment->status = "rejected";
                    $comment->save();
                    Notification::create([
                        "user_id" => $comment->user_id,
                        "type" => "post_status",
                        "message" => "Your Comment his been rejected due to community guide lines",
                        "url" => "#",
                    ]);
                } else {
                    $comment->status = "published";
                    $comment->save();
                    Notification::create([
                        "user_id" => $comment->user_id,
                        "type" => "post_status",
                        "message" => "Your Comment his been published",
                        "url" => route("single-post", ["useruuid" => $comment->user->uuid, "postuuid" => $comment->post->uuid]),
                    ]);
                }
            }
        })->everyMinute();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
