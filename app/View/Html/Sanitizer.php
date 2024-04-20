<?php

namespace App\View\Html;

use Symfony\Component\HtmlSanitizer\HtmlSanitizer;

class Sanitizer
{
    public function __construct(private HtmlSanitizer $sanitizer)
    {
    }

    public function sanitizeFor(string $element, string $input): string
    {
        return $this->sanitizer->sanitizeFor($element, $input);
    }
}
