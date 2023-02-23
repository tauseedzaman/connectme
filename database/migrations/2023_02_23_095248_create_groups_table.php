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
        Schema::create('groups', function (Blueprint $table) {
            $table->id();
            $table->uuid("uuid");
            $table->foreignId("user_id")->constrained()->cascadeOnDelete();
            $table->stirng("icon");
            $table->stirng("thumbnail");
            $table->text("description")->nullable();
            $table->stirng("name");
            $table->stirng("location")->nullable();
            $table->stirng("type");
            $table->unsignedBigInteger("members")->default(0);
            $table->boolean("is_private")->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('groups');
    }
};
