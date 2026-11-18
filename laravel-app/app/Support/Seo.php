<?php

namespace App\Support;

use Illuminate\Support\Str;

/**
 * Helpers for page meta tags (title and description shown by Google and when a link is shared).
 */
class Seo
{
    public const SITE_NAME = 'Jiva Birth & Beyond';

    /** Google shows roughly the first 155-160 characters of a meta description. */
    public const DESCRIPTION_LENGTH = 155;

    /**
     * Plain-text summary of some content for a meta description: tags, emoji/symbols at the start and extra
     * whitespace removed, cut at a word boundary.
     */
    public static function excerpt(?string $content, int $limit = self::DESCRIPTION_LENGTH): string
    {
        $text = html_entity_decode(strip_tags((string) $content), ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $text = preg_replace('/^[^\p{L}\p{N}]+/u', '', $text);
        $text = trim(preg_replace('/\s+/u', ' ', $text));

        return Str::limit($text, $limit, '…', preserveWords: true);
    }

    /** "Page name | Jiva Birth & Beyond" */
    public static function title(string $name): string
    {
        return trim($name) . ' | ' . self::SITE_NAME;
    }
}
