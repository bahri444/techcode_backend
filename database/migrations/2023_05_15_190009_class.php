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
        Schema::create('class', function (Blueprint $table) {
            $table->uuid('class_uuid')->primary();
            $table->foreignUuid('profession_uuid');
            $table->string('class_name');
            $table->string('price_class');
            $table->char('class_duration');
            $table->date('start_date');
            $table->date('end_date');
            $table->timestamps();
            $table->foreign('profession_uuid')->references('profession_uuid')->on('professions')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::drop('class');
    }
};
