<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Tonysm\RichTextLaravel\Models\Traits\HasRichText;

class Chirp extends Model
{
    use HasFactory;
    use HasRichText;

    protected $fillable = [
        'content',
    ];

    protected $richTextAttributes = [
        'content',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
