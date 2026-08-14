<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = User::firstOrCreate(
            ['email' => 'andyharyoko@gmail.com'],
            [
                'name' => 'Andy Haryoko',
                'password' => bcrypt('password'),
            ]
        );

        $this->call([
            DupakDataSeeder::class,
        ]);
    }
}
