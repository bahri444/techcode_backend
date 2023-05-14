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
        Schema::create('users', function (Blueprint $table) {
            $table->id('user_id');
            $table->string('nama_lengkap', 25);
            $table->string('email', 30)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->enum('role', ['member', 'mentor', 'pengurus', 'superadmin'])->default('member');
            $table->date('tanggal_lahir')->nullable();
            $table->enum('jenis_kelamin', ['pria', 'wanita'])->nullable();
            $table->string('alamat', 50)->nullable();
            $table->string('foto', 30)->nullable();
            $table->string('github', 20)->nullable();
            $table->enum('jenis_anggota', ['percobaan', 'pasti', 'kehormatan'])->default('percobaan');
            $table->enum('status_anggota', ['nonaktif', 'aktif'])->default('nonaktif');
            $table->char('angkatan', 4)->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
