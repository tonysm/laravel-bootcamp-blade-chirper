<?php

use App\View\Html\Sanitizer;
use Illuminate\Support\HtmlString;

if (! function_exists('h')) {
    function h(string $html, string $element = 'body'): HtmlString
    {
        $sanitizer = resolve(Sanitizer::class);

        return new HtmlString($sanitizer->sanitizeFor($element, $html));
    }
}
