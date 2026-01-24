<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        User::create([
            'name' => 'Чопоров Владислав',
            'login' => 'choporov.vlad',
            'password' => '1234choporov',
            'balance' => 1000,
            'referral_link' => 'choporov-vladislav-1',
        ]);
    }
}
