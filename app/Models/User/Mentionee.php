<?php

namespace App\Models\User;

use Tonysm\RichTextLaravel\Attachables\Attachable;

trait Mentionee
{
    use Attachable;

    const ATTACHABLE_CONTENT_TYPE = 'application/vnd.chirper.user-mention+html';

    public function richTextAsPlainText(): string
    {
        return e($this->name);
    }

    public function richTextRender(array $options = []): string
    {
        return trim(view('rich-texts.partials.mention', [
            'user' => $this,
        ])->render());
    }

    public function richTextContentType(): string
    {
        return static::ATTACHABLE_CONTENT_TYPE;
    }
}
