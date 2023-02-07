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
        Schema::create('article_tags', function (Blueprint $table) {
            $table->foreignId('article_id')
                ->references('id')->on('articles');
            $table->foreignId('tag_id')
                ->references('id')->on('tags');
            $table->primary(['article_id', 'tag_id']);
        });
    }

    /**
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('article_tags');
    }
};
