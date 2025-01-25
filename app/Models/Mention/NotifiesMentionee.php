<?php

namespace App\Models\Mention;

use App\Models\Mention;
use App\Notifications\MentionedInChirp;

trait NotifiesMentionee
{
    public static function bootNotifiesMentionee(): void
    {
        static::created(function (Mention $mention) {
            $mention->notifyMentioneeLater();
        });
    }

    protected function notifyMentioneeLater(): void
    {
        if ($this->mentionee->isNot($this->chirp->user)) {
            $this->mentionee->notify(
                new MentionedInChirp($this->chirp)
            );
        }
    }
}
