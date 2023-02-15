<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('article_foreign_tag', function (Blueprint $table) {
            $table->foreignId('article_id')
                ->references('id')->on('articles');
            $table->foreignId('foreign_tag_id')
                ->references('id')->on('foreign_tags');
            $table->primary(['article_id', 'foreign_tag_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('article_foreign_tag');
    }
};
