<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $users = [
            'James T. Kirk',
            'Spock',
            'Leonard McCoy',
            'Jean-Luc Picard',
            'Data',
            'William Riker',
            'Benjamin Sisko',
            'Kathryn Janeway',
            'Seven of Nine',
            'Worf',
        ];

        foreach ($users as $name) {
            User::factory()->create([
                'name' => $name,
            ]);
        }
    }
}
