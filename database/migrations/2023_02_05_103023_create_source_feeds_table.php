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
            $table->string('url')->nullable();
            $table->string('keywords')->nullable();
            $table->string('countries')->nullable();
            $table->string('categories')->nullable();
            $table->string('sources')->nullable();
            $table->string('languages')->nullable();
            $table->enum('sort', SourceFeed::getAvailableSorts())->nullable();
            $table->enum('type', SourceFeed::getAvailableTypes())
                ->default(SourceFeed::TYPE_MEDIASTACK);
            $table->string('latest_article_marker')->nullable();
            $table->timestamp('latest_processed_at')->nullable();
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
