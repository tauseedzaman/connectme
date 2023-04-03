<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->uuid("uuid");
            $table->foreignId("user_id")->constrained()->cascadeOnDelete();
            $table->longText("content");
            $table->boolean("is_public")->default(1);
            $table->enum("status", ["published", "pending", "rejected"])->default("pending");
            $table->unsignedBigInteger("likes")->default(0);
            $table->unsignedBigInteger("comments")->default(0);
            $table->boolean("is_page_post")->default(0);
            $table->foreignId("page_id")->nullable()->constrained()->cascadeOnDelete();
            $table->boolean("is_group_post")->default(0);
            $table->foreignId("group_id")->nullable()->constrained()->cascadeOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
