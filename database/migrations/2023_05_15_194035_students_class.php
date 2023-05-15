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
        Schema::create('students_class', function (Blueprint $table) {
            $table->uuid('student_class_uuid')->primary();
            $table->foreignUuid('user_uuid');
            $table->foreignUuid('class_uuid');
            $table->date('date_checkout_class');
            $table->enum('price_state', ['pending', 'belum_lunas', 'lunas'])->default('pending');
            $table->timestamps();
            $table->foreign('user_uuid')->references('user_uuid')->on('users')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('class_uuid')->references('class_uuid')->on('class')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::drop('students_class');
    }
};
