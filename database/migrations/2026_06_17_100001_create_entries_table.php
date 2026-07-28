<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('entries', function (Blueprint $table) {
            $table->id();
            $table->string('headword');
            $table->string('headword_lower')->index();      // normalized for search
            $table->string('letter', 4)->nullable()->index(); // first letter (A..Y)
            $table->unsignedInteger('homonym_index')->nullable();
            $table->string('pos_code', 50)->nullable();
            $table->string('pos_category', 50)->nullable()->index();
            $table->boolean('is_khabar_only')->default(false);
            $table->string('gender', 10)->nullable();          // m / f / b
            $table->unsignedTinyInteger('verb_class')->nullable();
            $table->string('verb_class_label')->nullable();
            $table->string('verb_transitivity', 10)->nullable();
            $table->string('conjugation_raw')->nullable();
            $table->string('noun_plural_raw')->nullable();
            $table->json('noun_plural')->nullable();
            $table->string('domain', 50)->nullable()->index();
            $table->json('domains')->nullable();               // all domains seen on the entry
            $table->string('redirect_to')->nullable();
            $table->unsignedBigInteger('redirect_to_id')->nullable()->index();
            $table->unsignedInteger('source_page')->nullable();
            $table->text('raw_body')->nullable();
            $table->text('search_blob')->nullable();           // headword + glosses + synonyms
            $table->timestamps();

            $table->index('headword');
        });

        // Full-text search across headword and definition blob (MySQL/MariaDB).
        // Non-fatal: search falls back to LIKE if FULLTEXT is unavailable.
        try {
            DB::statement('ALTER TABLE entries ADD FULLTEXT ft_search (headword, search_blob)');
        } catch (\Throwable $e) {
            // ignore — engine without FULLTEXT support
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('entries');
    }
};
