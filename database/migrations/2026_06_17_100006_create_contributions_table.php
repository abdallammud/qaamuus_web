<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contributions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('entry_id')->constrained('entries')->cascadeOnDelete();
            // explanation | synonym | example_sentence | dialect_variant
            $table->string('type', 30)->index();
            $table->text('content');
            $table->string('dialect')->nullable();   // for dialect_variant / same word in a dialect
            // pending | approved | rejected
            $table->string('status', 20)->default('approved')->index();
            $table->timestamps();
            $table->index(['entry_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contributions');
    }
};
