<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        "uuid",
        "user_id",
        "content",
        "status",
        'is_public',
        "likes",
        "comments",
        "is_page_post",
        "page_id",
        "is_group_post",
        "group_id",
    ];

    /**
     * Get all of the comments for the Post
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function commentss(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
    /**
     * Get the user that owns the Story
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the group that owns the post
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class, 'group_id');
    }

     /**
     * Get the page that owns the post
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function page(): BelongsTo
    {
        return $this->belongsTo(Page::class, 'page_id');
    }
}
