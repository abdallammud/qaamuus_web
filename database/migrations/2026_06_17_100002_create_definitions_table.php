<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('definitions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('entry_id')->constrained('entries')->cascadeOnDelete();
            $table->unsignedInteger('sense_number')->default(1);
            $table->string('gloss_prefix')->nullable();
            $table->text('gloss');
            $table->string('domain', 50)->nullable();
            $table->string('partial_synonym')->nullable();
            $table->index('entry_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('definitions');
    }
};
