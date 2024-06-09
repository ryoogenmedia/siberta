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
        Schema::create('revision', function (Blueprint $table) {
            $table->id();
            $table->foreignId('berkas_id')->nullable();
            $table->foreignId('mahasiswa_id')->nullable();
            $table->foreignId('user_id')->nullable();
            $table->string('date_revision')->nullable();
            $table->string('gathering_limit_date')->nullable();
            $table->string('provider_name')->nullable();
            $table->text('note_revision')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('revision');
    }
};
