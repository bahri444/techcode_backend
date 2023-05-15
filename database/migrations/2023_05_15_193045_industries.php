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
        Schema::create('industries', function (Blueprint $table) {
            $table->uuid('industry_uuid')->primary();
            $table->string('industry_name')->comment('nama perusahaan');
            $table->string('industy_logo')->comment('logo perusahaan');
            $table->string('vision')->comment('visi');
            $table->string('mision')->comment('misi');
            $table->string('objective')->comment('tujuan');
            $table->string('social_media');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::drop('industries');
    }
};
