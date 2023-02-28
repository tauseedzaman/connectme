<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        "uuid",
        "user_id",
        "content",
        "status",
        "likes",
        "comments",
        "is_page_post",
        "page_id",
        "is_group_post",
        "group_id",
    ];
}
