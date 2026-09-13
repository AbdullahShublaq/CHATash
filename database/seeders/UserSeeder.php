<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        User::firstOrCreate(
            [
                ['name' => 'ASHfox'],
                [
                    'email' => 'ash@fox.me',
                    'password' => Hash::make('ashfox123456*/'),
                    'is_admin' => Hash::make(1),
                ],
            ]
        );
    }
}
