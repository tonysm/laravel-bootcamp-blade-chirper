<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mentions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('chirp_id')->constrained()->cascadeOnDelete();
            $table->foreignId('mentionee_id')->constrained('users')->cascadeOnDelete();
            $table->timestamps();

            $table->unique(['chirp_id', 'mentionee_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mentions');
    }
};
