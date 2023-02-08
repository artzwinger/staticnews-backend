<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * @return void
     */
    public function up(): void
    {
        Schema::create('feed_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('source_feed_id')->nullable();
            $table->foreignId('article_id')->nullable();
            $table->string('author');
            $table->string('title');
            $table->text('description');
            $table->string('url');
            $table->string('source');
            $table->string('image', 512);
            $table->string('category');
            $table->char('language', 2);
            $table->char('country', 2);
            $table->timestamp('source_published_at');
            $table->timestamps();
        });
    }

    /**
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('feed_items');
    }
};
