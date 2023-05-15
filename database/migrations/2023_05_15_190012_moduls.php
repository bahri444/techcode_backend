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
        Schema::create('moduls', function (Blueprint $table) {
            $table->uuid('modul_uuid')->primary();
            $table->foreignUuid('modul_categories_uuid');
            $table->foreignUuid('class_uuid');
            $table->string('modul_title', 100);
            $table->string('modul_files', 70);
            $table->char('modul_to', 3);
            $table->enum('learn_state', [0, 1]);
            $table->timestamps();
            $table->foreign('modul_categories_uuid')->references('modul_categories_uuid')->on('modul_categories')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('class_uuid')->references('class_uuid')->on('class')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::drop('moduls');
    }
};
