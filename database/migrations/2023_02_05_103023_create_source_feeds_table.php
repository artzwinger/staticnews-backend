<?php

use App\Models\SourceFeed;
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
            $table->string('keywords')->nullable();
            $table->string('countries')->nullable();
            $table->string('categories')->nullable();
            $table->string('sources')->nullable();
            $table->string('languages')->nullable();
            $table->enum('sort', SourceFeed::getAvailableSorts())
                ->default(SourceFeed::SORT_PUBLISHED_DESC);
            $table->string('latest_article_marker')->nullable();
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
