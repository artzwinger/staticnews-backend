<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * @return void
     */
    public function up(): void
    {
        Schema::create('foreign_tag_maps', function (Blueprint $table) {
            $table->id();
            $table->string('foreign_tag')->index();
            $table->foreignId('tag_id')->index();
            $table->unique(['foreign_tag', 'tag_id']);
        });
    }

    /**
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('foreign_tag_maps');
    }
};
