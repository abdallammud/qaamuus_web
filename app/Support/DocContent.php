<?php

namespace App\Support;

use Illuminate\Support\Facades\Cache;

/**
 * Loads structured document content (extracted from the source PDFs) used by
 * the "About the dictionary" (Intro) and "Naxwe / Grammar" pages.
 *
 * Each document is a JSON file under resources/content with the shape:
 *   { "title": "...", "sections": [ {id,num,title,level,html,page}, ... ] }
 */
class DocContent
{
    public static function load(string $name): array
    {
        return Cache::rememberForever("doc_content_{$name}", function () use ($name) {
            $path = resource_path("content/{$name}.json");
            if (! is_file($path)) {
                return ['title' => ucfirst($name), 'sections' => []];
            }
            return json_decode(file_get_contents($path), true) ?: ['title' => '', 'sections' => []];
        });
    }
}
