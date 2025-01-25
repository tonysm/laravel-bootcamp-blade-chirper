<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property-read Chirp $chirp
 * @property-read User $mentionee
 */
class Mention extends Model
{
    /** @use HasFactory<\Database\Factories\MentionFactory> */
    use HasFactory;
    use Mention\NotifiesMentionee;

    protected $guarded = [];

    public function chirp(): BelongsTo
    {
        return $this->belongsTo(Chirp::class);
    }

    public function mentionee(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
