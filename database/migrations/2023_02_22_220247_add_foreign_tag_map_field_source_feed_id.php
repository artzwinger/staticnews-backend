<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table('foreign_tag_maps', function (Blueprint $table) {
            $table->foreignId('source_feed_id')->index();
            try {
                $table->dropForeign('foreign_tag_maps_website_id_foreign');
                $table->dropUnique(['website_id', 'foreign_tag_id', 'tag_id']);
                $table->unique(['website_id', 'source_feed_id', 'foreign_tag_id', 'tag_id'], 'unique_mapping');
            } catch (\Exception $e) {
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        //
    }
};
