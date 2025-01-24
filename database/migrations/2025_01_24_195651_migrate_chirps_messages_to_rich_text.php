<?php

use App\Models\Chirp;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Chirp::withoutTouching(function () {
            Chirp::withoutTimestamps(function () {
                Chirp::query()->withoutGlobalScopes()->eachById(function (Chirp $chirp) {
                    $chirp->update([
                        'content' => $chirp->message,
                    ]);
                });
            });
        });

        Schema::dropColumns('chirps', 'message');
    }
};
