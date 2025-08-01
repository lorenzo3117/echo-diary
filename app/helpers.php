<?php

use Illuminate\Support\HtmlString;
use Symfony\Component\HtmlSanitizer\HtmlSanitizer;
use Symfony\Component\HtmlSanitizer\HtmlSanitizerConfig;

if (!function_exists('sanitizeHtml')) {
    function sanitizeHtml($html): HtmlString
    {
        return new HtmlString((new HtmlSanitizer(
            (new HtmlSanitizerConfig())->allowSafeElements()
        ))->sanitize($html));
    }
}
