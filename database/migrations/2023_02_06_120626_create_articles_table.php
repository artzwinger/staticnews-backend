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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('website_id')
                ->references('id')->on('websites');
            $table->foreignId('source_feed_id')->nullable()
                ->references('id')->on('source_feeds');
            $table->string('slug', 500)->unique();
            $table->string('title', 500);
            $table->string('source_link');
            $table->string('author');
            $table->text('description');
            $table->text('content');
            $table->string('image_filename')->nullable();
            $table->boolean('updated')->default(false);
            $table->timestamp('foreign_created_at')->nullable();
            $table->timestamp('published_at')->nullable();
            $table->timestamp('created_at')->nullable();
        });
    }

    /**
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
