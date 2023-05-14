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
        Schema::create('actifity', function (Blueprint $table) {
            $table->uuid('actifity_uuid')->primary();
            $table->foreignUuid('actifity_categories_uuid');
            $table->string('actifity_name', 50)->comment('nama kegiatan');
            $table->string('actifity_foto', 55)->comment('foto kegiatan');
            $table->longText('description')->comment('deskripsi kegiatan');
            $table->string('place_actifity', 40)->comment('tempat kegiatan');
            $table->date('start_date')->comment('tanggal mulai');
            $table->date('end_date')->comment('tanggal berakhir');
            $table->enum('actifity_status', ['inti', 'rutin', 'event']);
            $table->timestamps();
            $table->foreign('actifity_categories_uuid')->references('actifity_categories_uuid')->on('actifity_categories')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::drop('actifity');
    }
};
