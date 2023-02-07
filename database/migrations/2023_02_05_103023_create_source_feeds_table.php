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
        Schema::create('source_feeds', function (Blueprint $table) {
            $table->id();
            $table->foreignId('website_id')
                ->references('id')->on('websites');
            $table->string('url');
            $table->string('latest_article_marker');
        });
    }

    /**
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('source_feeds');
    }
};
