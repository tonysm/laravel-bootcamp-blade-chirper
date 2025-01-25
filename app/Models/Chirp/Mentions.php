<?php

namespace App\Models\Chirp;

use App\Models\Chirp;
use App\Models\Mention;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\UniqueConstraintViolationException;

trait Mentions
{
    public static function bootMentions(): void
    {
        static::saved(function (Chirp $chirp) {
            $chirp->syncMentions();
        });
    }

    public function mentions(): HasMany
    {
        return $this->hasMany(Mention::class);
    }

    protected function syncMentions(): void
    {
        $mentionedUsers = (clone $this->content)->attachables()
            ->filter(fn ($attachable) => $attachable instanceof User)
            ->values();

        $this->mentions()
            ->when($mentionedUsers->isNotEmpty(), fn ($query) => (
                $query->whereNotIn('mentionee_id', $mentionedUsers->pluck('id')->all())
            ))
            ->delete();

        foreach ($mentionedUsers as $user) {
            try {
                $this->mentions()->create([
                    'mentionee_id' => $user->getKey(),
                ]);
            } catch (UniqueConstraintViolationException) {
                // No need to anything...
            }
        }
    }
}
